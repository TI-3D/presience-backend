<?php

namespace App\Livewire;

use App\Models\Attendance;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
// use Filament\Tables\Actions\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Component;
use Illuminate\Database\Eloquent\Model;

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
                    ->infolist(
                        function (Model $record) {
                            // dd($record->student);
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
                                        // TextEntry::make('class')
                                        //     ->label('Kelas')
                                        //     ->default(fn() => $record->scheduleWeek->schedule->group->name)->columnSpan([
                                        //         'sm' => 1,
                                        //         'lg' => 1,
                                        //     ]),

                                        // TextEntry::make('course')
                                        //     ->label('Mata Kuliah')
                                        //     ->default(fn() => $record->scheduleWeek->schedule->course->name)->columnSpan([
                                        //         'sm' => 1,
                                        //         'lg' => 1,
                                        //     ]),
                                        // TextEntry::make('week')
                                        //     ->label('Minggu')
                                        //     ->default(fn() => $record->scheduleWeek->week->name)->columnSpan([
                                        //         'sm' => 1,
                                        //         'lg' => 1,
                                        //     ]),
                                        // TextEntry::make('type_permit')
                                        //     ->label('Jenis Izin')
                                        //     ->badge()
                                        //     ->color('warning')
                                        //     ->default(fn() => $record->permit->type_permit)->columnSpan([
                                        //         'sm' => 1,
                                        //         'lg' => 1,
                                        //     ])->formatStateUsing(function ($state) {
                                        //         if ($state === 'izin') {
                                        //             return 'Izin';
                                        //         } else if ($state === 'sakit') {
                                        //             return 'Sakit';
                                        //         }
                                        //         // Customize badge text based on the 'status' value
                                        //         return $state;
                                        //     }),
                                        // TextEntry::make('declaration')
                                        //     ->label('Deskripsi')
                                        //     ->default(fn() => $record->permit->description)->columnSpan([
                                        //         'sm' => 1,
                                        //         'lg' => 3,
                                        //     ]),
                                        // ImageEntry::make('header_image')->label('Dokumen')->columnSpan([
                                        //     'sm' => 1,
                                        //     'lg' => 3,
                                        // ]),
                                        // ImageEntry::make('header_image')
                                        //     ->label('Dokumen')
                                        //     ->default(fn() => $record->permit->evidence)
                                        //     ->columnSpan([
                                        //         'sm' => 1,
                                        //         'lg' => 3,
                                        //     ])
                                    ])
                            ];
                        }
                    )
            ])
            ->query(fn() => Attendance::where('schedule_week_id', $this->scheduleWeekId)
                ->where(function ($query) use ($courseTime) {
                    $query->where('sakit', '=', $courseTime)
                        ->orWhere('izin', '=', $courseTime);
                })->with('student'));
    }

    public function render()
    {
        return view('livewire.attendance-permission-table');
    }
}
