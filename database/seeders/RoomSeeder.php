<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('rooms')->insert([

            // Dont change rooms bellow

            ['name' => 'RT01', 'floor' => '5', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT02', 'floor' => '5', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT03', 'floor' => '5', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT04', 'floor' => '5', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT05', 'floor' => '5', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT06', 'floor' => '5', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT07', 'floor' => '5', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LPY1', 'floor' => '5', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],

            ['name' => 'LSI3', 'floor' => '6', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LSI2', 'floor' => '6', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LSI1', 'floor' => '6', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LPY2', 'floor' => '6', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LPY3', 'floor' => '6', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],

            ['name' => 'LPR1', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LPR2', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LPR3', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LPR4', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LPR5', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LPR6', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LKJ1', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LPR7', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LKJ2', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LERP', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LKJ3', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LIG1', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT8', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LIG2', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LPY4', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LAI1', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],

            ['name' => 'RT9', 'floor' => '8', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT10', 'floor' => '8', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT11', 'floor' => '8', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT12', 'floor' => '8', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT13', 'floor' => '8', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT14', 'floor' => '8', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LAI2', 'floor' => '8', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LDT', 'floor' => '8', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],

            ['name' => 'LPR8', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],

            // Dont change rooms above
            // Put the new rooms bellow

        ]);
    }
}
