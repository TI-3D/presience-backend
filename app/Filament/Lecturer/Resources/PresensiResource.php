<?php

namespace App\Filament\Lecturer\Resources;

use App\Filament\Lecturer\Resources\PresensiResource\Pages;
use App\Models\Schedule;
use App\Models\ScheduleWeek;
use App\Models\User;
use App\Models\Week;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Support\Colors\Color;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Radio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PresensiResource extends Resource
{
    protected static ?string $model = ScheduleWeek::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function sendNotification($weekId, $title, $message)
    {
        // Cari schedule yang memiliki week_id yang diberikan
        $schedule = Schedule::whereHas('scheduleWeeks', function ($query) use ($weekId) {
            $query->where('week_id', $weekId);
        })->first();

        if (!$schedule) {
            Log::error("Schedule with week_id {$weekId} not found.");
            return;
        }

        // Cari pengguna dengan group_id yang sama dengan schedule
        $users = User::where('group_id', $schedule->group_id)->get();

        foreach ($users as $user) {
            $token = $user->fcm_id;
            if ($token) {
                $messaging = app('firebase.messaging');
                $notification = FirebaseNotification::create($title, $message);

                $message = CloudMessage::withTarget('token', $token)
                    ->withNotification($notification);

                try {
                    $messaging->send($message);
                } catch (\Exception $e) {
                    Log::error('Failed to send notification', ['error' => $e->getMessage()]);
                }
            }
        }
    }

    public static function getEloquentQuery(): Builder
    {

        // Get the current week's ID (or calculate based on your business logic)
        $currentWeek = Week::where('start_date', '<=', now()->toDateString())
            ->where('end_date', '>=', now()->toDateString())
            ->first();

        $currentWeekId = optional($currentWeek)->id;

        // dd($currentWeekId);

        // Ensure that we have a valid week ID before applying the filter
        if (!$currentWeekId) {
            // Handle cases where the current week is not found (optional)
            $data = parent::getEloquentQuery() // Filter ScheduleWeek by week_id
                ->whereHas('schedule', function ($query) { // Ensure schedule's lecturer_id matches the authenticated user
                    $query->where('lecturer_id', auth()->id());
                });
            return $data;
        }

        // Query to filter by lecturer_id and limit to current or previous weeks
        $data = parent::getEloquentQuery()
            ->where('week_id', '<=', $currentWeekId) // Filter ScheduleWeek by week_id
            ->whereHas('schedule', function ($query) { // Ensure schedule's lecturer_id matches the authenticated user
                $query->where('lecturer_id', auth()->id());
            });

        // dd($data->get());
        return $data;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('schedule.course.name')
                    ->searchable()
                    ->sortable()
                    ->label('Mata Kuliah'),
                // ->url(fn(Model $record) => route('filament.lecturer.resources.presensis.view', ['scheduleWeekId' == 1])),
                Tables\Columns\TextColumn::make('week.name')
                    ->label('Minggu')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn(string $state): string => "Minggu ke-{$state}"),
                Tables\Columns\TextColumn::make('schedule.group.name')
                    ->searchable()
                    ->sortable()
                    ->label('Kelas'),
                BadgeColumn::make('status')
                    ->sortable()
                    ->colors([
                        'gray' => 'closed',
                        'success' => 'opened',
                    ])
                    ->label('Status')
                    ->formatStateUsing(function ($state) {
                        if ($state === 'closed') {
                            return 'Belum Dibuka';
                        } else if ($state === 'opened') {
                            return 'Aktif';
                        }
                        // Customize badge text based on the 'status' value
                        return $state;
                    }),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('buka')
                    ->label('Buka')
                    ->color(Color::Indigo)
                    ->modalWidth('md')
                    ->modalHeading('Jenis Kelas')
                    // ->modalSubheading('Pilih Jenis Kelas Offline atau Online')
                    ->form([
                        Radio::make("class_type")
                            ->label('Pilih jenis kelas')
                            // ->boolean("0")
                            ->inline()
                            ->inlineLabel(false)
                            ->default('offline')
                            ->reactive()
                            ->options([
                                'offline' => 'Luring',
                                'online' => 'Daring'
                            ])->descriptions([
                                'offline' => 'Wajah dan lokasi mahasiswa akan divalidasi ketika melakukan presensi',
                                'online' => 'Hanya wajah mahasiswa yang akan divalidasi ketika melakukan presensi'
                            ])
                    ])
                    ->action(function (Model $record, array $data) {
                        // dd($data);
                        $classType = $data['class_type'];

                        if ($classType === 'offline') {
                            $record->update([
                                'status' => 'opened',
                                'opened_at' => now(),
                                'is_online' => false,
                            ]);

                            Notification::make()
                                ->title('Berhasil membuka kelas offline')
                                ->success()
                                ->send();

                            $weekId = $record->week_id;
                            $resourceInstance = new self();
                            $resourceInstance->sendNotification($weekId, 'Ada Absen Kelas Offline Hari Ini!!!', 'Absen yuk jangan sampe terlambat, nanti jadi alpha deh🥺');
                        } elseif ($classType === 'online') {
                            $record->update([
                                'status' => 'opened',
                                'opened_at' => now(),
                                'is_online' => true,
                            ]);

                            Notification::make()
                                ->title('Berhasil membuka kelas online')
                                ->success()
                                ->send();

                            $weekId = $record->week_id;
                            $resourceInstance = new self();
                            $resourceInstance->sendNotification($weekId, 'Ada Absen Kelas Online Hari Ini!!!', 'Absen yuk jangan sampe terlambat, nanti jadi alpha deh🥺');
                        } else {
                            Notification::make()
                                ->title('Pilih jenis kelas sebelum melanjutkan')
                                ->warning()
                                ->send();
                        }
                    })

                    ->disabled(fn(Model $record) => $record->status == 'opened')
                    ->button(),

                Tables\Actions\Action::make('viewDetails')
                    ->label('Detail')
                    ->modalHeading('Detail Presensi')
                    ->color(Color::Indigo)
                    ->modalWidth("Medium")
                    ->modalContent(function (Model $record) {
                        $attendances = $record->attendances()->with('student')->get();
                        return view('components.attendance-modal', ['attendances' => $attendances]);
                    })
                    ->modalActions([
                        Tables\Actions\Action::make('confirm')
                            ->label('Tutup Presensi')
                            ->after(function () {
                                // Tutup modal setelah aksi selesai
                                return redirect(request()->header('Referer'));
                            })
                            ->action(function (Model $record, $action) {
                                $attendances = $record->attendances()->with('student')->get();
                                $attendances->each(function ($attendance) {
                                    $attendance->update(['lecturer_verified' => 1]);
                                });
                                try {
                                    $record->update([
                                        'status' => 'closed',
                                        'closed_at' => Carbon::now(),
                                    ]);
                                } catch (\Exception $e) {
                                    dd($e->getMessage());
                                }

                                Notification::make()
                                    ->title('Berhasil menutup presendi')
                                    ->success()
                                    ->send();
                            })
                            ->color(Color::Indigo)
                            ->disabled(fn(Model $record) => $record->status === 'closed')
                    ])

                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPresensis::route('/'),
        ];
    }

    public static function getLabel(): ?string
    {
        return 'Presensi';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Presensi';
    }
}
