<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $groups = [
            'TI-1A',
            'TI-1B',
            'TI-1C',

            'SIB-1A',
            'SIB-1B',
            'SIB-1C',

        ];

        foreach ($groups as $group) {
            Group::create(['name' => $group]);
        }
    }
}
