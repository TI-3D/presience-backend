<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('schedules')->insert([
            [
                'day' => 'monday',
                'start_time' => '07:50',
                'end_time' => '13:40',
                'lecturer_id' => 1,
                'group_id' => 4,
                'room_id' => 1,
                'course_id' => 1,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 2,
                'group_id' => 4,
                'room_id' => 2,
                'course_id' => 2,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '11:20',
                'end_time' => '17:10',
                'lecturer_id' => 3,
                'group_id' => 4,
                'room_id' => 3,
                'course_id' => 3,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 4,
                'group_id' => 4,
                'room_id' => 4,
                'course_id' => 4,
            ],
            [
                'day' => 'thursday',
                'start_time' => '13:40',
                'end_time' => '17:10',
                'lecturer_id' => 5,
                'group_id' => 4,
                'room_id' => 5,
                'course_id' => 6,
            ],
            [
                'day' => 'friday',
                'start_time' => '07:50',
                'end_time' => '11:20',
                'lecturer_id' => 6,
                'group_id' => 4,
                'room_id' => 6,
                'course_id' => 7,
            ],

            [
                'day' => 'friday',
                'start_time' => '14:30',
                'end_time' => '18:00',
                'lecturer_id' => 7,
                'group_id' => 4,
                'room_id' => 7,
                'course_id' => 8,
            ],
        ]);
    }
}
