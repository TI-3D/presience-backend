<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StudentCountWidget extends BaseWidget
{
    protected int | string | array $columnSpan = '2';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Mahasiswa', User::count())
                ->description('Jumlah total dari mahasiswa')
                ->color('primary')
                ->icon('heroicon-o-users')
        ];
    }
}
