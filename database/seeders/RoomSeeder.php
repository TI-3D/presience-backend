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
            ['name' => 'LS1', 'floor' => '6', 'latitude' => '-7.944065', 'longitude' => '112.614603'],
            ['name' => 'LS3', 'floor' => '6', 'latitude' => '-7.944065', 'longitude' => '112.614603'],
            ['name' => 'RT13', 'floor' => '8', 'latitude' => '-7.944065', 'longitude' => '112.614603'],
            ['name' => 'RT14', 'floor' => '8', 'latitude' => '-7.944065', 'longitude' => '112.614603'],
            ['name' => 'RT10', 'floor' => '8', 'latitude' => '-7.944065', 'longitude' => '112.614603'],
            ['name' => 'LKJ1', 'floor' => '7', 'latitude' => '-7.944065', 'longitude' => '112.614603'],
            ['name' => 'RT7', 'floor' => '5', 'latitude' => '-7.944065', 'longitude' => '112.614603'],
            ['name' => 'LIG2', 'floor' => '7', 'latitude' => '-7.944065', 'longitude' => '112.614603'],
        ]);
    }
}
