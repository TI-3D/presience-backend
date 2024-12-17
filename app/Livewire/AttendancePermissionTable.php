<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Permit;
use App\Models\PermitDetail;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Components\ImageEntry;
use Filament\Notifications\Notification;
use Filament\Tables\Contracts\HasTable;
// use Filament\Tables\Actions\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Filament\Support\Colors\Color;

class AttendancePermissionTable extends Component implements HasTable, HasForms
{

    use InteractsWithTable;
    use InteractsWithForms;


    public ?int $scheduleWeekId = null;
    public ?int $courseTime = null;

    public function mount($scheduleWeekId, $courseTime)
    {
        $this->scheduleWeekId = $scheduleWeekId;
        $this->courseTime = $courseTime;
    }

    public function table(Table $table): Table
    {
        $courseTime = $this->courseTime;
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.nim')
                    ->label('NIM')
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Nama')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->getStateUsing(function (Model $record) {
                        // Assuming you have 'sakit', 'izin', and 'alpha' columns in the attendance table
                        $statuses = [];

                        if ($record->sakit > 0) {
                            $statuses[] = 'Sakit';
                        }

                        if ($record->izin > 0) {
                            $statuses[] = 'Izin';
                        }

                        if ($record->alpha > 0) {
                            $statuses[] = 'Alpha';
                        }

                        // Join the statuses to display them together, separated by commas
                        return !empty($statuses) ? implode(', ', $statuses) : 'Hadir';
                    })->colors([
                        'danger' => fn($state) => str_contains($state, 'Alpha'), // Red for Alpha
                        'warning' => fn($state) => str_contains($state, 'Sakit') || str_contains($state, 'Izin'), // Yellow for Sakit/Izin
                        'success' => fn($state) => $state === 'Hadir', // Green for Hadir
                    ]),

            ])
            ->actions([

                Tables\Actions\Action::make('lihat')
                    ->label('Lihat') // Label of the button
                    ->icon('heroicon-o-eye') // Optional: You can use an icon from Heroicons
                    ->color('gray') // Optional: Set the color of the button
                    ->tooltip('Detail') // Optional: Tooltip when hovering over the button
                    ->modalWidth("Medium")
                    ->modalHeading('Perizinan')
                    ->modalActions([
                        Tables\Actions\Action::make('confirm')
                            ->label('Konfirmasi')
                            ->after(function () {
                                // Tutup modal setelah aksi selesai
                                return redirect(request()->header('Referer'));
                            })
                            ->action(function (Model $record, $action) {
                                try {
                                    DB::transaction(function () use ($record) {
                                        // Update is_changed dan lecturer_verified
                                        DB::table('attendances as a')
                                            ->where('schedule_week_id', '=', $this->scheduleWeekId)
                                            ->where('a.student_id', $record->student->id)
                                            ->update([
                                                'is_changed' => true,
                                                'a.lecturer_verified' => true
                                            ]);
                                        $permissionDetail = $record->scheduleWeek->permissionDetails->first();
                                        if ($permissionDetail) {
                                            $permissionDetail->update(['status' => 'confirm']);
                                        }
                                    });

                                    Notification::make()
                                        ->title('Berhasil menyetujui perizinan')
                                        ->success()
                                        ->send();
                                } catch (\Exception $e) {
                                    Notification::make()
                                        ->title('Gagal menyetujui perizinan')
                                        ->danger()
                                        ->send();
                                }
                            })
                            ->disabled(fn(Model $record) => $record->scheduleWeek->permissionDetails->first()?->status != 'proses')

                            ->color(Color::Blue),
                        Tables\Actions\Action::make('decline')
                            ->label('Tolak')
                            ->after(function () {
                                return redirect(request()->header('Referer'));
                            })
                            ->action(function (Model $record) {
                                try {
                                    DB::transaction(function () use ($record) {
                                        $scheduleWeek = DB::table('schedule_weeks as sw')
                                            ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
                                            ->join('courses as c', 's.course_id', '=', 'c.id')
                                            ->where('sw.id', $this->scheduleWeekId)
                                            ->select('*')
                                            ->first();
                                        // Update is_changed dan lecturer_verified
                                        DB::table('attendances as a')
                                            ->where('schedule_week_id', '=', $this->scheduleWeekId)
                                            ->where('a.student_id', $record->student->id)
                                            ->update([
                                                'is_changed' => DB::raw("CASE WHEN a.lecturer_verified = true THEN true ELSE is_changed END"),
                                                'a.lecturer_verified' => true,
                                                'alpha' => $scheduleWeek->time,
                                                'izin' => 0,
                                                'sakit' => 0
                                            ]);
                                        //  Delete permit data
                                        $permitId = $record->scheduleWeek->permissionDetails->first()?->permit?->id;
                                        DB::table('permit_details')->where('permit_id', $permitId)->delete();
                                        DB::table('permits')->where('id', $permitId)->delete();
                                    });

                                    Notification::make()
                                        ->title('Berhasil menolak perizinan')
                                        ->success()
                                        ->send();
                                } catch (\Exception $e) {
                                    Notification::make()
                                        ->title('Gagal menolak perizinan')
                                        ->danger()
                                        ->send();
                                }
                            })
                            ->disabled(fn(Model $record) => $record->scheduleWeek->permissionDetails->first()?->status != 'proses')

                            ->color(Color::Gray),

                    ])
                    ->infolist(
                        function (Model $record) {

                            // dd($record);
                            // dd($record->scheduleWeek);
                            // dd($record->scheduleWeek->permissionDetails->first()?->permit?->type_permit );
                            return [
                                Section::make()
                                    ->columns([
                                        'sm' => 1,
                                        'lg' => 3,
                                    ])
                                    ->schema([
                                        TextEntry::make('nim')
                                            ->label('NIM')
                                            ->default(fn() => $record->student->nim)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ]),

                                        TextEntry::make('name')
                                            ->label('Nama')
                                            ->default(fn() => $record->student->name)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ]),
                                        TextEntry::make('class')
                                            ->label('Kelas')
                                            ->default(fn() => $record->scheduleWeek->schedule->group->name)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ]),

                                        TextEntry::make('course')
                                            ->label('Mata Kuliah')
                                            ->default(fn() => $record->scheduleWeek->schedule->course->name)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ]),
                                        TextEntry::make('week')
                                            ->label('Minggu')
                                            ->default(fn() => $record->scheduleWeek->week->name)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ]),
                                        TextEntry::make('type_permit')
                                            ->label('Jenis Izin')
                                            ->badge()
                                            ->color('warning')
                                            ->default(fn() => $record->scheduleWeek->permissionDetails->first()?->permit?->type_permit)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ])->formatStateUsing(function ($state) {
                                                if ($state === 'izin') {
                                                    return 'Izin';
                                                } else if ($state === 'sakit') {
                                                    return 'Sakit';
                                                }
                                                // Customize badge text based on the 'status' value
                                                return $state;
                                            }),
                                        TextEntry::make('description')
                                            ->label('Deskripsi')
                                            ->default(fn() => $record->scheduleWeek->permissionDetails->first()?->permit?->description)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 3,
                                            ]),
                                        ImageEntry::make('header_image')
                                            ->label('Dokumen')
                                            ->default(fn() => $record->scheduleWeek->permissionDetails->first()?->permit?->evidence)
                                            ->columnSpan([
                                                'sm' => 1,
                                                'lg' => 3,
                                            ]),
                                    ])
                            ];
                        }
                    )
            ])
            // ->query(function () use ($courseTime) {
            //     // Gunakan Eloquent Model dan relasi untuk join
            //     $data = Attendance::leftJoin('schedule_weeks', 'attendances.schedule_week_id', '=', 'schedule_weeks.id')
            //     ->leftJoin('schedules', 'schedule_weeks.schedule_id', '=', 'schedules.id')
            //     ->leftJoin('groups', 'schedules.group_id', '=', 'groups.id')
            //     ->leftJoin('permit_details', 'schedule_weeks.id', '=', 'permit_details.schedule_week_id')
            //     ->leftJoin('permits', 'permit_details.permit_id', '=', 'permits.id')
            //     ->select(
            //         'attendances.*',
            //         'schedule_weeks.*',
            //         'schedules.*',
            //         'groups.*',
            //         'permit_details.*',
            //         'permits.*'
            //     )
            //     ->where('attendances.schedule_week_id', $this->scheduleWeekId)
            //     ->where(function ($query) use ($courseTime) {
            //         $query->where('attendances.sakit', '=', $courseTime)
            //             ->orWhere('attendances.izin', '=', $courseTime);
            //     });

            //     dd($data->get());
            //     return $data;
            // });
            ->query(function () use ($courseTime) {
                // $query = Attendance::where('schedule_week_id', $this->scheduleWeekId)
                //     ->where(function ($query) use ($courseTime) {
                //         $query->where('sakit', '=', $courseTime)
                //             ->orWhere('izin', '=', $courseTime);
                //     })->with(
                //         'student',
                //         'scheduleWeek.schedule.group',
                //         'scheduleWeek.permissionDetails.permit',
                //     );

                // if (!$query) {
                //     return Attendance::where('schedule_week_id', $this->scheduleWeekId)
                //         ->where(function ($query) use ($courseTime) {
                //             $query->where('sakit', '=', $courseTime)
                //                 ->orWhere('izin', '=', $courseTime);
                //         })->with(
                //             'student',
                //             // 'scheduleWeek.schedule.group',
                //             // 'scheduleWeek.permissionDetails.permit',
                //         );
                // }

                return Attendance::query()
                    ->leftJoin('schedule_weeks', 'attendances.schedule_week_id', '=', 'schedule_weeks.id')
                    ->leftJoin(
                        'permit_details',
                        'schedule_weeks.id',
                        '=',
                        'permit_details.schedule_week_id'
                    )
                    ->leftJoin('permits', 'permit_details.permit_id', '=', 'permits.id')
                    ->with('student') // Tetap gunakan relasi yang diperlukan
                    ->select('attendances.*', 'schedule_weeks.id as sw_id', 'permit_details.id as pd_id', 'permits.id as p_id')
                    ->where('attendances.schedule_week_id', $this->scheduleWeekId)
                    ->where(function ($query) use ($courseTime) {
                        $query->where('attendances.sakit', '=', $courseTime)
                            ->orWhere(
                                'attendances.izin',
                                '=',
                                $courseTime
                            );
                    });


                // return $query;
            });
    }

    public function render()
    {
        return view('livewire.attendance-permission-table');
    }
}
