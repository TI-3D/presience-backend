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
