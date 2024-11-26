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

    public ?int $selectedCourse = null;

    public ?int $selectedGroup = null;

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
                try {
                    $messaging = app('firebase.messaging');
                    $notification = FirebaseNotification::create($title, $message);

                    $message = CloudMessage::withTarget('token', $token)
                        ->withNotification($notification);

                    $messaging->send($message);
                } catch (\Exception $e) {
                    Log::error('Failed to send notification', ['error' => $e->getMessage()]);
                }
            }
        }
    }

    public static function getEloquentQuery(): Builder
    {
        // Mengambil query dasar
        $query = parent::getEloquentQuery();

        // Mengambil filter dari session
        $selectedCourse = session('selected_course', null);
        $selectedGroup = session('selected_group', null);

        if (is_null($selectedCourse) && is_null($selectedGroup)) {
            return $query->whereRaw('1 = 0'); // Membuat query yang selalu false, mengembalikan data kosong
        }

        // Terapkan filter berdasarkan session
        if ($selectedCourse) {
            $query->whereHas('schedule', function ($query) use ($selectedCourse) {
                $query->where('course_id', $selectedCourse);
            });
        }

        if ($selectedGroup) {
            $query->whereHas('schedule', function ($query) use ($selectedGroup) {
                $query->where('group_id', $selectedGroup);
            });
        }

        // Filter untuk minggu ini
        $currentWeek = Week::where('start_date', '<=', now()->toDateString())
            ->where('end_date', '>=', now()->toDateString())
            ->first();

        if ($currentWeek) {
            $query->where('week_id', '<=', $currentWeek->id);
        }

        // Pastikan hanya data yang relevan dengan dosen yang terpilih yang ditampilkan
        return $query->whereHas('schedule', function ($query) {
            $query->where('lecturer_id', auth()->id());
        });
    }




    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table->heading(function () {
            if (!is_null(session('selected_course')) && !is_null(session('selected_group'))) {
                $courseName = \App\Models\Course::find(session('selected_course'))->name ?? '';

                $groupName = \App\Models\Group::find(session('selected_group'))->name ?? '';

                return $courseName . ' - ' . $groupName;
            } else {
                return '-';
            }
        })
            ->headerActions([

                Tables\Actions\Action::make('filterCourse')
                    ->label('Pilih Mata Kuliah')
                    ->form([
                        Forms\Components\Select::make('course_id')
                            ->label('Pilih Mata Kuliah')
                            ->options(
                                \App\Models\Course::whereHas('schedules', function ($query) {
                                    $query->where('lecturer_id', auth()->id());
                                })->pluck('name', 'id')
                            )
                            ->reactive()
                            ->placeholder('Semua Mata Kuliah'),

                        Forms\Components\Select::make('group_id')
                            ->label('Pilih Kelas')
                            ->options(function (callable $get) {
                                $courseId = $get('course_id');
                                if (!$courseId) {
                                    return [];
                                }
                                return \App\Models\Group::whereHas('schedules', function ($query) use ($courseId) {
                                    $query->where('lecturer_id', auth()->id())
                                        ->where('course_id', $courseId);
                                })->pluck('name', 'id');
                            })
                            ->placeholder('Semua Kelas'),
                    ])
                    ->action(function (array $data) {
                        // Menyimpan filter ke dalam session
                        session([
                            'selected_course' => $data['course_id'] ?? null,
                            'selected_group' => $data['group_id'] ?? null,
                        ]);

                        // Refresh tabel setelah filter diterapkan
                        Notification::make()
                            ->title('Filter berhasil diterapkan')
                            ->success()
                            ->send();
                    })
                    ->button(),

            ])
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
                // ])->groups([
                //     Group::make('courses.name')->label('Mata Kuliah'),
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
                            redirect()->route('filament.lecturer.resources.presensis.detail', ['scheduleWeekId' => $record->id]);
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
                            redirect()->route('filament.lecturer.resources.presensis.detail', ['scheduleWeekId' => $record->id]);
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
                    ->url(function (Model $record) {
                        // Assuming $record is an instance of ScheduleWeek, use $record->id as scheduleWeekId
                        // dd($record);
                        if ($record->status == 'opened') {
                            return route('filament.lecturer.resources.presensis.view', ['scheduleWeekId' => $record->id]);
                        } else {
                            return route('filament.lecturer.resources.presensis.detail', ['scheduleWeekId' => $record->id]);
                        }
                        // return route('filament.lecturer.resources.presensis.view', ['scheduleWeekId' => $record->id]);
                    }),


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
            'view' => Pages\ViewPresensi::route('/view'),
            'detail' => Pages\DetailPresensiPage::route('/detail'),
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
