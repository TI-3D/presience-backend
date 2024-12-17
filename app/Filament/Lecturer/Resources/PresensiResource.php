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

    public static function sendNotification($groupId, $title, $message)
    {
        // Cari pengguna berdasarkan group_id
        $users = User::where('group_id', $groupId)
            ->select('name', 'fcm_id')
            ->get()
            ->filter(function ($user) {
                return !empty($user->fcm_id); // Hanya ambil user dengan fcm_id yang tidak kosong
            });

        if ($users->isEmpty()) {
            Log::info("No users found with group_id {$groupId}");
            return;
        }

        try {
            $messaging = app('firebase.messaging');

            foreach ($users as $user) {
                $notification = FirebaseNotification::create('Hai ' . explode(' ', $user->name)[0] . ', ' . $title, $message);

                $cloudMessage = CloudMessage::withTarget('token', $user->fcm_id)
                    ->withNotification($notification);

                $messaging->send($cloudMessage);
            }
            Log::info("Notification sent to group_id {$groupId}");
        } catch (\Exception $e) {
            Log::error('Failed to send notification', [
                'error' => $e->getMessage()
            ]);
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
            ->paginated([20, 50, 100, 'all'])
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
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->getStateUsing(function (Model $record) {
                        if ($record->status == 'closed') {
                            return $record->closed_at === null ? 'Belum Dibuka' : 'Ditutup';
                        }

                        if ($record->status == 'opened') {
                            return 'Aktif';
                        }
                    })->colors([
                        'primary' => fn($state) => $state === 'Aktif',
                        'gray' => fn($state) => $state === 'Belum Dibuka',
                        'danger' => fn($state) => $state === 'Ditutup',
                    ]),
            ])
            ->filters([
                //
                // ])->groups([
                //     Group::make('courses.name')->label('Mata Kuliah'),
            ])
            ->defaultSort(function ($query) {
                $query->orderBy('id', 'desc');
            })
            ->actions([
                Tables\Actions\Action::make('buka')
                    ->label('Buka')
                    ->color('primary')
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
                        $course = $record->schedule->course->name;

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

                            $resourceInstance = new self();
                            $resourceInstance->sendNotification(session('selected_group'), 'Ada Absen Kelas Offline ' . $course . '!!!', 'Absen yuk jangan sampe terlambat, nanti jadi alpha deh🥺');
                            redirect()->route('filament.lecturer.resources.presensis.view', ['scheduleWeekId' => $record->id]);
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

                            $resourceInstance = new self();
                            $resourceInstance->sendNotification(session('selected_group'), 'Ada Absen Kelas Online ' . $course . '!!!', 'Absen yuk jangan sampe terlambat, nanti jadi alpha deh🥺');
                            redirect()->route('filament.lecturer.resources.presensis.view', ['scheduleWeekId' => $record->id]);
                        } else {
                            Notification::make()
                                ->title('Pilih jenis kelas sebelum melanjutkan')
                                ->warning()
                                ->send();
                        }
                    })

                    ->disabled(function (Model $record) {
                        if ($record->status == 'closed') {
                            return $record->closed_at === null ? false : true;
                        }

                        if ($record->status == 'opened') {
                            return true;
                        }
                    })
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
