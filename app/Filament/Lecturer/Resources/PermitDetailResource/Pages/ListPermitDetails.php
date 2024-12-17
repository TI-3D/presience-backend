<?php

namespace App\Filament\Lecturer\Resources\PermitDetailResource\Pages;

use App\Filament\Lecturer\Resources\PermitDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermitDetails extends ListRecords
{
    protected static string $resource = PermitDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
