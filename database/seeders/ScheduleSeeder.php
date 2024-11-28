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
            // TI 3A
            [
                'day' => 'monday',
                'start_time' => '10:30',
                'end_time' => '12:10',
                'lecturer_id' => 14,
                'group_id' => 1,
                'room_id' => 2,
                'course_id' => 5,
            ],
            [
                'day' => 'monday',
                'start_time' => '12:50',
                'end_time' => '18:00',
                'lecturer_id' => 10,
                'group_id' => 1,
                'room_id' => 36,
                'course_id' => 1,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 9,
                'group_id' => 1,
                'room_id' => 15,
                'course_id' => 8,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '12:50',
                'end_time' => '16:20',
                'lecturer_id' => 6,
                'group_id' => 1,
                'room_id' => 35,
                'course_id' => 7,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '12:50',
                'end_time' => '16:20',
                'lecturer_id' => 11,
                'group_id' => 1,
                'room_id' => 37,
                'course_id' => 6,
            ],
            [
                'day' => 'thursday',
                'start_time' => '07:50',
                'end_time' => '11:20',
                'lecturer_id' => 13,
                'group_id' => 1,
                'room_id' => 30,
                'course_id' => 2,
            ],
            [
                'day' => 'thursday',
                'start_time' => '11:20',
                'end_time' => '17:10',
                'lecturer_id' => 3,
                'group_id' => 1,
                'room_id' => 27,
                'course_id' => 3,
            ],
            [
                'day' => 'friday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 12,
                'group_id' => 1,
                'room_id' => 25,
                'course_id' => 4,
            ],
            // TI 3B
            [
                'day' => 'monday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 12,
                'group_id' => 2,
                'room_id' => 22,
                'course_id' => 4,
            ],
            [
                'day' => 'monday',
                'start_time' => '14:30',
                'end_time' => '18:00',
                'lecturer_id' => 13,
                'group_id' => 2,
                'room_id' => 34,
                'course_id' => 2,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 15,
                'group_id' => 2,
                'room_id' => 23,
                'course_id' => 3,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '14:30',
                'end_time' => '16:20',
                'lecturer_id' => 14,
                'group_id' => 2,
                'room_id' => 32,
                'course_id' => 5,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 9,
                'group_id' => 2,
                'room_id' => 27,
                'course_id' => 8,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '14:30',
                'end_time' => '18:00',
                'lecturer_id' => 6,
                'group_id' => 2,
                'room_id' => 3,
                'course_id' => 7,
            ],
            [
                'day' => 'thursday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 10,
                'group_id' => 2,
                'room_id' => 18,
                'course_id' => 1,
            ],
            [
                'day' => 'friday',
                'start_time' => '08:40',
                'end_time' => '12:10',
                'lecturer_id' => 11,
                'group_id' => 2,
                'room_id' => 35,
                'course_id' => 6,
            ],
            // TI 3C
            [
                'day' => 'monday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 9,
                'group_id' => 3,
                'room_id' => 36,
                'course_id' => 8,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 10,
                'group_id' => 3,
                'room_id' => 18,
                'course_id' => 1,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 15,
                'group_id' => 3,
                'room_id' => 18,
                'course_id' => 3,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '12:50',
                'end_time' => '14:30',
                'lecturer_id' => 8,
                'group_id' => 3,
                'room_id' => 7,
                'course_id' => 5,
            ],
            [
                'day' => 'thursday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 15,
                'group_id' => 3,
                'room_id' => 4,
                'course_id' => 2,
            ],
            [
                'day' => 'thursday',
                'start_time' => '12:50',
                'end_time' => '16:20',
                'lecturer_id' => 16,
                'group_id' => 3,
                'room_id' => 14,
                'course_id' => 6,
            ],
            [
                'day' => 'friday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 18,
                'group_id' => 3,
                'room_id' => 12,
                'course_id' => 4,
            ],
            // TI 3D
            [
                'day' => 'monday',
                'start_time' => '07:50',
                'end_time' => '13:40',
                'lecturer_id' => 1,
                'group_id' => 4,
                'room_id' => 8,
                'course_id' => 1,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 2,
                'group_id' => 4,
                'room_id' => 11,
                'course_id' => 2,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '11:20',
                'end_time' => '17:10',
                'lecturer_id' => 3,
                'group_id' => 4,
                'room_id' => 27,
                'course_id' => 3,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 4,
                'group_id' => 4,
                'room_id' => 9,
                'course_id' => 4,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '12:50',
                'end_time' => '14:30',
                'lecturer_id' => 8,
                'group_id' => 4,
                'room_id' => 7,
                'course_id' => 5,
            ],
            [
                'day' => 'thursday',
                'start_time' => '13:40',
                'end_time' => '17:10',
                'lecturer_id' => 5,
                'group_id' => 4,
                'room_id' => 32,
                'course_id' => 6,
            ],
            [
                'day' => 'friday',
                'start_time' => '07:50',
                'end_time' => '11:20',
                'lecturer_id' => 6,
                'group_id' => 4,
                'room_id' => 34,
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
            // TI 3E
            [
                'day' => 'monday',
                'start_time' => '12:50',
                'end_time' => '16:20',
                'lecturer_id' => 19,
                'group_id' => 5,
                'room_id' => 14,
                'course_id' => 2,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '07:00',
                'end_time' => '08:40',
                'lecturer_id' => 8,
                'group_id' => 5,
                'room_id' => 35,
                'course_id' => 5,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '11:20',
                'end_time' => '15:20',
                'lecturer_id' => 11,
                'group_id' => 5,
                'room_id' => 12,
                'course_id' => 6,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 21,
                'group_id' => 5,
                'room_id' => 20,
                'course_id' => 4,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '12:50',
                'end_time' => '18:00',
                'lecturer_id' => 20,
                'group_id' => 5,
                'room_id' => 20,
                'course_id' => 1,
            ],
            [
                'day' => 'thursday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 22,
                'group_id' => 5,
                'room_id' => 22,
                'course_id' => 3,
            ],
            [
                'day' => 'friday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 17,
                'group_id' => 5,
                'room_id' => 6,
                'course_id' => 7,
            ],
            [
                'day' => 'friday',
                'start_time' => '10:30',
                'end_time' => '14:30',
                'lecturer_id' => 7,
                'group_id' => 5,
                'room_id' => 24,
                'course_id' => 8,
            ],
            // TI 3F
            [
                'day' => 'monday',
                'start_time' => '11:20',
                'end_time' => '13:40',
                'lecturer_id' => 8,
                'group_id' => 6,
                'room_id' => 30,
                'course_id' => 5,
            ],
            [
                'day' => 'monday',
                'start_time' => '13:40',
                'end_time' => '17:10',
                'lecturer_id' => 28,
                'group_id' => 6,
                'room_id' => 20,
                'course_id' => 6,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '10:30',
                'end_time' => '16:20',
                'lecturer_id' => 1,
                'group_id' => 6,
                'room_id' => 10,
                'course_id' => 1,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 17,
                'group_id' => 6,
                'room_id' => 31,
                'course_id' => 7,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '12:50',
                'end_time' => '18:00',
                'lecturer_id' => 25,
                'group_id' => 6,
                'room_id' => 23,
                'course_id' => 3,
            ],
            [
                'day' => 'thursday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 7,
                'group_id' => 6,
                'room_id' => 20,
                'course_id' => 8,
            ],
            [
                'day' => 'thursday',
                'start_time' => '11:20',
                'end_time' => '16:20',
                'lecturer_id' => 24,
                'group_id' => 6,
                'room_id' => 38,
                'course_id' => 4,
            ],
            [
                'day' => 'friday',
                'start_time' => '10:30',
                'end_time' => '14:30',
                'lecturer_id' => 19,
                'group_id' => 6,
                'room_id' => 3,
                'course_id' => 2,
            ],
            // TI 3G
            [
                'day' => 'monday',
                'start_time' => '07:50',
                'end_time' => '13:40',
                'lecturer_id' => 13,
                'group_id' => 7,
                'room_id' => 24,
                'course_id' => 1,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '07:00',
                'end_time' => '08:40',
                'lecturer_id' => 8,
                'group_id' => 7,
                'room_id' => 3,
                'course_id' => 5,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '10:30',
                'end_time' => '14:30',
                'lecturer_id' => 17,
                'group_id' => 7,
                'room_id' => 34,
                'course_id' => 7,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '12:50',
                'end_time' => '18:00',
                'lecturer_id' => 27,
                'group_id' => 7,
                'room_id' => 36,
                'course_id' => 3,
            ],
            [
                'day' => 'thursday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 4,
                'group_id' => 7,
                'room_id' => 25,
                'course_id' => 4,
            ],
            [
                'day' => 'thursday',
                'start_time' => '12:50',
                'end_time' => '16:20',
                'lecturer_id' => 26,
                'group_id' => 7,
                'room_id' => 18,
                'course_id' => 2,
            ],
            [
                'day' => 'friday',
                'start_time' => '07:50',
                'end_time' => '11:20',
                'lecturer_id' => 28,
                'group_id' => 7,
                'room_id' => 7,
                'course_id' => 6,
            ],
            [
                'day' => 'friday',
                'start_time' => '12:50',
                'end_time' => '16:20',
                'lecturer_id' => 22,
                'group_id' => 7,
                'room_id' => 36,
                'course_id' => 8,
            ],
            // TI 3H
            [
                'day' => 'monday',
                'start_time' => '07:50',
                'end_time' => '11:20',
                'lecturer_id' => 22,
                'group_id' => 8,
                'room_id' => 18,
                'course_id' => 8,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 29,
                'group_id' => 8,
                'room_id' => 32,
                'course_id' => 6,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '11:20',
                'end_time' => '13:40',
                'lecturer_id' => 8,
                'group_id' => 8,
                'room_id' => 7,
                'course_id' => 5,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 25,
                'group_id' => 8,
                'room_id' => 29,
                'course_id' => 3,
            ],
            [
                'day' => 'thursday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 17,
                'group_id' => 8,
                'room_id' => 35,
                'course_id' => 7,
            ],
            [
                'day' => 'thursday',
                'start_time' => '11:20',
                'end_time' => '17:10',
                'lecturer_id' => 13,
                'group_id' => 8,
                'room_id' => 19,
                'course_id' => 1,
            ],
            [
                'day' => 'friday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 24,
                'group_id' => 8,
                'room_id' => 9,
                'course_id' => 4,
            ],
            [
                'day' => 'friday',
                'start_time' => '12:50',
                'end_time' => '16:20',
                'lecturer_id' => 26,
                'group_id' => 8,
                'room_id' => 5,
                'course_id' => 2,
            ],
            // TI 3I
            [
                'day' => 'monday',
                'start_time' => '13:40',
                'end_time' => '15:20',
                'lecturer_id' => 23,
                'group_id' => 9,
                'room_id' => 30,
                'course_id' => 5,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 27,
                'group_id' => 9,
                'room_id' => 25,
                'course_id' => 2,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '10:30',
                'end_time' => '16:20',
                'lecturer_id' => 4,
                'group_id' => 9,
                'room_id' => 11,
                'course_id' => 4,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 22,
                'group_id' => 9,
                'room_id' => 23,
                'course_id' => 3,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '12:50',
                'end_time' => '16:20',
                'lecturer_id' => 17,
                'group_id' => 9,
                'room_id' => 2,
                'course_id' => 7,
            ],
            [
                'day' => 'thursday',
                'start_time' => '07:50',
                'end_time' => '11:20',
                'lecturer_id' => 16,
                'group_id' => 9,
                'room_id' => 9,
                'course_id' => 6,
            ],
            [
                'day' => 'thursday',
                'start_time' => '11:20',
                'end_time' => '16:20',
                'lecturer_id' => 1,
                'group_id' => 9,
                'room_id' => 9,
                'course_id' => 1,
            ],
            [
                'day' => 'friday',
                'start_time' => '07:50',
                'end_time' => '11:20',
                'lecturer_id' => 22,
                'group_id' => 9,
                'room_id' => 13,
                'course_id' => 8,
            ],

            // SIB 3A
            [
                'day' => 'monday',
                'start_time' => '13:40',
                'end_time' => '15:20',
                'lecturer_id' => 23,
                'group_id' => 9,
                'room_id' => 30,
                'course_id' => 5,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '07:00',
                'end_time' => '10:30',
                'lecturer_id' => 27,
                'group_id' => 9,
                'room_id' => 25,
                'course_id' => 2,
            ],
            [
                'day' => 'tuesday',
                'start_time' => '10:30',
                'end_time' => '16:20',
                'lecturer_id' => 4,
                'group_id' => 9,
                'room_id' => 11,
                'course_id' => 4,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '07:00',
                'end_time' => '12:10',
                'lecturer_id' => 22,
                'group_id' => 9,
                'room_id' => 23,
                'course_id' => 3,
            ],
            [
                'day' => 'wednesday',
                'start_time' => '12:50',
                'end_time' => '16:20',
                'lecturer_id' => 17,
                'group_id' => 9,
                'room_id' => 2,
                'course_id' => 7,
            ],
            [
                'day' => 'thursday',
                'start_time' => '07:50',
                'end_time' => '11:20',
                'lecturer_id' => 16,
                'group_id' => 9,
                'room_id' => 9,
                'course_id' => 6,
            ],
            [
                'day' => 'thursday',
                'start_time' => '11:20',
                'end_time' => '16:20',
                'lecturer_id' => 1,
                'group_id' => 9,
                'room_id' => 9,
                'course_id' => 1,
            ],
            [
                'day' => 'friday',
                'start_time' => '07:50',
                'end_time' => '11:20',
                'lecturer_id' => 22,
                'group_id' => 9,
                'room_id' => 13,
                'course_id' => 8,
            ],
        ]);
    }
}
