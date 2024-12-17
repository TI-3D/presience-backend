<?php

namespace App\Livewire;

use App\Models\Attendance;
use Exception;
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

class AttendanceTable extends Component implements HasTable, HasForms
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
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.nim')
                    ->label('NIM')
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('entry_time')
                    ->label('Waktu Presensi')
                    ->dateTime('H:i:s')
                    ->sortable(),

            ])
            ->actions([
                Tables\Actions\Action::make('delete')
                    ->label('Hapus') // Label of the button
                    ->icon('heroicon-o-trash') // Optional: You can use an icon from Heroicons
                    ->color('danger') // Optional: Set the color of the button
                    ->tooltip('Hapus') // Optional: Tooltip when hovering over the button
                    ->action(function (Model $record, array $data) {



                        try {
                            $record->update([
                                'alpha' => $this->courseTime,
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
            ->query(fn() => Attendance::where('schedule_week_id', $this->scheduleWeekId)
                ->where('sakit', 0)
                ->where('izin', 0)
                ->where('alpha', 0)->with('student'));
    }

    public function render()
    {
        return view('livewire.attendance-table');
    }
}
