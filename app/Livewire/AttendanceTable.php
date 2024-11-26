<?php

namespace App\Livewire;

use App\Models\Attendance;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
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

    public function mount($scheduleWeekId)
    {
        $this->scheduleWeekId = $scheduleWeekId;
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
                // You may add these actions to your table if you're using a simple
                // resource, or you just want to be able to delete records without
                // leaving the table.
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                // ...
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
