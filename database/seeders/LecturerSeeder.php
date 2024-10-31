<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('lecturers')->insert([
            ['email' => 'dosen@gmail.com', 'password' => bcrypt('dosen123'), 'nip' => '19780521', 'name' => 'Dr. Eng. Rosa Andrie Asmara, S.T., M.T.'],
            ['email' => 'dosen@gmail.com', 'password' => bcrypt('dosen123'), 'nip' => '19820214', 'name' => 'Triana Fatmawati, S.T., M.T.'],
            ['email' => 'dosen@gmail.com', 'password' => bcrypt('dosen123'), 'nip' => '19850607', 'name' => 'Amalia Agung Septarina.S.S.M.Tr.TT.'],
            ['email' => 'dosen@gmail.com', 'password' => bcrypt('dosen123'), 'nip' => '19790111', 'name' => 'Dian Hanifudin Subhi, S.Kom., M.Kom.'],
            ['email' => 'dosen@gmail.com', 'password' => bcrypt('dosen123'), 'nip' => '19830503', 'name' => 'Hendra Pradibta, S.E., M.Sc.'],
            ['email' => 'dosen@gmail.com', 'password' => bcrypt('dosen123'), 'nip' => '19771109', 'name' => 'Atiqah Nurul Asri, S.Pd., M.Pd.'],
            ['email' => 'dosen@gmail.com', 'password' => bcrypt('dosen123'), 'nip' => '19800418', 'name' => 'Yuri Ariyanto, S.Kom., M.Kom.'],
        ]);
    }
}
