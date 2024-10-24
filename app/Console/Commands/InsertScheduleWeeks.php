<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InsertScheduleWeeks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:insert-schedule-weeks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert schedule week for each week starting from start_date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nextWeek = DB::table('weeks')->where('start_date', '>', Carbon::today())->first();

        if ($nextWeek) {
            $schedules = DB::table('schedules')->get();
            foreach ($schedules as $schedule) {
                if (strtolower($schedule->day) === 'monday') {
                    $scheduleDate = Carbon::parse($nextWeek->start_date)->subWeek()->next('Monday');
                } else {
                    $scheduleDate = Carbon::parse($nextWeek->start_date)->next(ucfirst($schedule->day));
                }
                DB::table('schedule_weeks')->insert([
                    'date' => $scheduleDate->format('Y-m-d'),
                    'is_online' => false,
                    'status' => 'closed',
                    'opened_at' => null,
                    'closed_at' => null,
                    'week_id' => $nextWeek->id,
                    'schedule_id' => $schedule->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->info('Schedule weeks successfully generated for week ' . $nextWeek->name);
        } else {
            $this->error('No upcoming week found.');
        }
    }
}
