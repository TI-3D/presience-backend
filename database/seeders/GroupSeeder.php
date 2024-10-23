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

            'SIB-3A',
            'SIB-3B',
            'SIB-3C',

        ];

        foreach ($groups as $group) {
            Group::create(['name' => $group]);
        }
    }
}
