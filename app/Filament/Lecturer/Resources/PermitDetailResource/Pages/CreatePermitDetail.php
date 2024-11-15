<?php

namespace App\Filament\Lecturer\Resources\PermitDetailResource\Pages;

use App\Filament\Lecturer\Resources\PermitDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePermitDetail extends CreateRecord
{
    protected static string $resource = PermitDetailResource::class;

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
