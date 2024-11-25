<?php

namespace App\Filament\Lecturer\Resources\PresensiResource\Widgets;

use App\Models\Attendance;
use Filament\Forms\Components\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AttendanceCountWidget extends BaseWidget
{

    public $scheduleWeekId=1;

    public function mount()
    {
        $this->scheduleWeekId = 1;
    }

    protected function getCards(): array
    {
        $alphaCount = Attendance::where('schedule_week_id', $this->scheduleWeekId)->where('alpha', '>', 0)->count();
        $sakitIzinCount = Attendance::where('schedule_week_id', $this->scheduleWeekId)
            ->where(function ($query) {
                $query->where('sakit', '>', 0)
                    ->orWhere('izin', '>', 0);
            })->count();
        $hadirCount = Attendance::where('schedule_week_id', $this->scheduleWeekId)
            ->where('sakit', 0)
            ->where('izin', 0)
            ->where('alpha', 0)
            ->count();
        return [
            Stat::make('Mahasiswa Terlambat', $alphaCount),
            Stat::make('Mahasiswa Sakit/Izin', $sakitIzinCount),
            Stat::make('Mahasiswa Hadir', $hadirCount),
            Stat::make('Mahasiswa Hadir', $alphaCount),

        ];
    }
}


