<?php

namespace App\Filament\Lecturer\Resources\PresensiResource\Pages;

use App\Filament\Lecturer\Resources\PresensiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Pages\ListRecords;

class EditPresensi extends ListRecords implements HasTable
{
    protected static string $resource = PresensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.nim')
                    ->searchable()
                    ->sortable()
                    ->label('NIM'),
                // Tables\Columns\TextColumn::make('week.name')
                //     ->label('Minggu')
                //     ->searchable()
                //     ->sortable()
                //     ->formatStateUsing(fn (string $state): string => "Minggu ke-{$state}"),
                // Tables\Columns\TextColumn::make('schedule.group.name')
                //     ->searchable()
                //     ->sortable()
                //     ->label('Kelas'),
                // BadgeColumn::make('status')
                //     ->sortable()
                //     ->colors([
                //         'primary' => 'closed',
                //         'success' => 'opened',
                //     ])
                //     ->label('Status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
