<?php

namespace App\Livewire;

use App\Models\Attendance;
use Exception;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
// use Filament\Tables\Actions\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Component;
use Illuminate\Database\Eloquent\Model;

class AttendanceAlphaTable extends Component implements HasTable, HasForms
{

    use InteractsWithTable;
    use InteractsWithForms;

    public ?int $scheduleWeekId = null;
    public ?int $courseTime = null;
    public ?int $maxValue = null;

    public function mount($scheduleWeekId, $courseTime)
    {
        // dd($courseTime);
        $this->scheduleWeekId = $scheduleWeekId;
        $this->courseTime = $courseTime;
        $this->maxValue = $courseTime;
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
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Ubah') // Label of the button
                    ->icon('heroicon-o-pencil-square') // Optional: You can use an icon from Heroicons
                    ->color('primary') // Optional: Set the color of the button
                    ->tooltip('Detail') // Optional: Tooltip when hovering over the button
                    ->modalWidth("sm")
                    ->modalHeading('Perizinan')
                    ->form(
                        function (Model $record) {
                            return [Grid::make(3)
                                ->schema([
                                    TextInput::make('nim')
                                        ->disabled()
                                        ->required()
                                        ->label('NIM')
                                        ->default($record->student->nim)->columnSpan(3),
                                    TextInput::make('name')
                                        ->disabled()
                                        ->required()
                                        ->label('Nama')
                                        ->default($record->student->name)->columnSpan(3),
                                    TextInput::make('alpha')
                                        ->required()
                                        ->label('Alpha')
                                        ->numeric()
                                        ->default($this->courseTime)
                                        ->maxValue($this->maxValue)
                                        ->minValue(0)
                                        ->reactive()
                                        ->columnSpan(1),
                                    TextInput::make('izin')
                                        ->required()
                                        ->label('Izin')
                                        ->numeric()
                                        ->default(0)
                                        ->maxValue($this->maxValue)
                                        ->minValue(0)
                                        ->reactive()
                                        ->columnSpan(1),
                                    TextInput::make('sakit')
                                        ->required()
                                        ->label('Sakit')
                                        ->numeric()
                                        ->default(0)
                                        ->maxValue($this->maxValue)
                                        ->minValue(0)
                                        ->reactive()
                                        ->columnSpan(1),
                                ])];
                        }
                    )
                    ->action(function (Model $record, array $data) {
                        try {
                            $record->update([
                                'alpha' => $data['alpha'],
                                'izin' => $data['izin'],
                                'sakit' => $data['sakit'],
                            ]);
                        } catch (Exception $e) {
                            Notification::make()
                                ->title('Gagal mengubah presensi')
                                ->danger()
                                ->send();
                        }
                        Notification::make()
                            ->title('Berhasil mengubah presensi')
                            ->success()
                            ->send();
                    }),
            ])
            ->query(fn() => Attendance::where('schedule_week_id', $this->scheduleWeekId)->where(function ($query) use ($courseTime) {
                $query->where('alpha', '=', $courseTime);
            })->with('student'));
    }

    public function render()
    {
        return view('livewire.attendance-alpha-table');
    }
}
