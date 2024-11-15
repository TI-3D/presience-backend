<?php

namespace App\Filament\Lecturer\Resources\PermitDetailResource\Pages;

use App\Filament\Lecturer\Resources\PermitDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermitDetail extends EditRecord
{
    protected static string $resource = PermitDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
