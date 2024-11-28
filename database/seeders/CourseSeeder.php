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
            ['name' => 'Pengolahan Citra dan Visi Komputer', 'sks' => 3, 'time' => 6],
            ['name' => 'Metodologi Penelitian', 'sks' => 2, 'time' => 4],
            ['name' => 'Pembelajaran Mesin', 'sks' => 3, 'time' => 6],
            ['name' => 'Pemrogaman Mobile', 'sks' => 3, 'time' => 6],
            ['name' => 'Kewarganegaraan', 'sks' => 2, 'time' => 2],
            ['name' => 'Kewirausahaan', 'sks' => 2, 'time' => 4],
            ['name' => 'Bahasa Inggris Persiapan Kerja', 'sks' => 2, 'time' => 4],
            ['name' => 'Administrasi dan Keamanan Jaringan', 'sks' => 2, 'time' => 4],
            ['name' => 'Audit Sistem Informasi', 'sks' => 2, 'time' => 4],
            ['name' => 'Kecerdasan Bisnis', 'sks' => 2, 'time' => 4],
            ['name' => 'Analisis dan Perancangan Sistem Informasi', 'sks' => 2, 'time' => 4],
            ['name' => 'Pemrogaraman Web Lanjut', 'sks' => 3, 'time' => 6],
            ['name' => 'Pemrogaraman Mobile', 'sks' => 3, 'time' => 6],
            ['name' => 'Workshop', 'sks' => 3, 'time' => 6],
            ['name' => 'Penjaminan Mutu Perangkat Lunak', 'sks' => 2, 'time' => 4],
        ]);
    }
}
