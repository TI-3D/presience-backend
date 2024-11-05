<?php

namespace App\Filament\Lecturer\Resources\PresensiResource\Pages;

use App\Filament\Lecturer\Resources\PresensiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePresensi extends CreateRecord
{
    protected static string $resource = PresensiResource::class;

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
