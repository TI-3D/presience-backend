<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $startDate = Carbon::create(2024, 10, 21); // Tanggal mulai dari minggu pertama (21 Oktober 2024)
        $weeks = [];

        for ($i = 1; $i <= 17; $i++) {
            // Tambahkan data untuk minggu ini
            $weeks[] = [
                'name' => (string)$i,
                'start_time' => $startDate->format('Y-m-d'), // Senin
                'end_time' => $startDate->copy()->addDays(4)->format('Y-m-d'), // Jumat
            ];

            // Tambah 1 minggu, langsung ke Senin berikutnya (5 hari + 2 hari akhir pekan)
            $startDate->addWeek();
        }

        // Insert data ke database
        DB::table('weeks')->insert($weeks);
    }
}
