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
            ['name' => 'LS1', 'floor' => '6', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LS3', 'floor' => '6', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT13', 'floor' => '8', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT14', 'floor' => '8', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT10', 'floor' => '8', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LKJ1', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'RT7', 'floor' => '5', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
            ['name' => 'LIG2', 'floor' => '7', 'latitude' => '-7.9720524', 'longitude' => '112.6146157'],
        ]);
    }
}
