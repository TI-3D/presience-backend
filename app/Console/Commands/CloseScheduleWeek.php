<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CloseScheduleWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CloseScheduleWeek';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');
        $scheduleWeeks = DB::table('schedule_weeks as sw')
            ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
            ->join('rooms as r', 's.room_id', '=', 'r.id')
            ->join('lecturers as l', 's.lecturer_id', '=', 'l.id')
            ->join('courses as c', 's.course_id', '=', 'c.id')
            ->join('weeks as w', 'sw.week_id', '=', 'w.id')
            ->where('sw.date', $today)
            ->select('sw.*', 's.*', 'r.*', 'sw.id as sw_id', 'r.name as room_name', 'l.name as lecturer_name', 'c.*', 'c.name as course_name', 'w.*')
            ->get();

        $scheduleWeeks->each(function ($schedule) {
            if ($schedule->end_time >= now()) {
                DB::table('schedule_weeks')
                ->where('id', $schedule->sw_id)
                    ->update([
                        'status' => 'closed',
                        'closed_at' => now(),
                    ]);
                $this->info("Schedule week ID {$schedule->sw_id} has been closed.");
            }
        });

        $this->info("Closed schedule weeks where end time has passed.");
    }
}
