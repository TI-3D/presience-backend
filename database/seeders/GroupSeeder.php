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
            'TI-3A',
            'TI-3B',
            'TI-3C',
            'TI-3D',
            'TI-3E',
            'TI-3F',
            'TI-3G',
            'TI-3H',
            'TI-3I',

            'SIB-3A',
            'SIB-3B',
            'SIB-3C',
            'SIB-3D',
            'SIB-3E',
        ];

        foreach ($groups as $group) {
            Group::create(['name' => $group]);
        }
    }
}
