<?php

namespace App\Filament\Lecturer\Resources\PresensiResource\Pages;

use App\Filament\Lecturer\Resources\PresensiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPresensis extends ListRecords
{
    protected static string $resource = PresensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
