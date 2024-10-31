<?php

namespace App\Filament\Resources\GroupResource\Widgets;

use App\Models\Group;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ClassCountWidget extends BaseWidget
{
    protected int | string | array $columnSpan = '2';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Kelas', Group::count())
                ->description('Jumlah total dari kelas')
                ->color('primary')
                ->icon('heroicon-o-users')
        ];
    }
}
