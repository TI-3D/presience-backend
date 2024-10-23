<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('courses')->insert([
            ['name' => 'Pengolahan Citra dan Visi Komputer', 'sks' => 3, 'time' => 300],
            ['name' => 'Metodologi Penelitian', 'sks' => 2, 'time' => 200],
            ['name' => 'Pembelajaran Mesin', 'sks' => 3, 'time' => 300],
            ['name' => 'Pemrogaman Mobile', 'sks' => 3, 'time' => 300],
            ['name' => 'Kewarganegaraan', 'sks' => 2, 'time' => 100],
            ['name' => 'Kewirausahaan', 'sks' => 2, 'time' => 200],
            ['name' => 'Bahasa Inggris Persiapan Kerja', 'sks' => 2, 'time' => 200],
            ['name' => 'Administrasi dan Keamanan Jaringan', 'sks' => 2, 'time' => 200],
        ]);
    }
}
