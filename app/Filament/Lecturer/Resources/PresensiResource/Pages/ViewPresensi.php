<?php

namespace App\Filament\Lecturer\Resources\PresensiResource\Pages;

use App\Filament\Lecturer\Resources\PresensiResource;
use App\Models\Attendance;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;

class ViewPresensi extends Page {
    protected static string $resource = PresensiResource::class;

    public $scheduleWeekId;

    public function mount($scheduleWeekId)
    {
        $this->scheduleWeekId = $scheduleWeekId;
    }

    protected static ?string $title = "Detail Presensi";
    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.nim')
                    ->label('NIM')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('entry_time')
                    ->label('Waktu Presensi')
                    ->dateTime('H:i:s')
                    ->sortable(),
            ])
            ->query(fn() => Attendance::where('schedule_week_id', $this->scheduleWeekId)->with('student'));
    }
}
