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

            // Dont change rooms bellow

            ['email' => 'rosa@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '19780521', 'name' => 'Dr. Eng. Rosa Andrie Asmara, S.T., M.T.'],
            ['email' => 'triana@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '19820214', 'name' => 'Triana Fatmawati, S.T., M.T.'],
            ['email' => 'amalia@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '19850607', 'name' => 'Amalia Agung Septarina.S.S.M.Tr.TT.'],
            ['email' => 'dian@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '19790111', 'name' => 'Dian Hanifudin Subhi, S.Kom., M.Kom.'],
            ['email' => 'hendra@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '19830503', 'name' => 'Hendra Pradibta, S.E., M.Sc.'],
            ['email' => 'atiqah@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '19771109', 'name' => 'Atiqah Nurul Asri, S.Pd., M.Pd.'],
            ['email' => 'yuri@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '19800418', 'name' => 'Yuri Ariyanto, S.Kom., M.Kom.'],
            ['email' => 'ariyanti@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Ariyanti, S.H., M.H., LL.M.'],
            ['email' => 'ade@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Ade Ismail S.Kom., M.TI'],
            ['email' => 'cahya@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Cahya Rahmad, ST., M.Kom., Dr. Eng.'],
            ['email' => 'dhebys@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Dhebys Suryani, S.Kom., MT'],
            ['email' => 'sofyan@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Sofyan Noor Arief, S.ST., M.Kom.'],
            ['email' => 'ulla@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Ulla Delfana Rosiani, ST., MT., Dr.'],
            ['email' => 'widaningsih@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Dr. Widaningsih Condrowardhani, SH, MH.'],
            ['email' => 'ely@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Ely Sety Astuti, ST., MT.'],
            ['email' => 'agung@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Agung  Nugroho Pramudhita, S.T., M.T.'],
            ['email' => 'farida@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Farida Ulfa, S.Pd. M.Pd.'],
            ['email' => 'samsul@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Samsul Arifin, S.Kom.MMSI'],
            ['email' => 'erfan@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Erfan Rohadi, ST>, M.Eng., Ph.D.'],
            ['email' => 'mamluatul@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Mamluatul Haniah, S.Kom., M.Kom.'],
            ['email' => 'usman@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Usman Nurhasan, S,Kom., MT.'],
            ['email' => 'vipkas@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Vipkas Al Hadid Firdaus, ST,. MT'],
            ['email' => 'ane@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Dr. Ane Fany Novitasari, SH., M.Kn'],
            ['email' => 'habibie@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Habibie Ed Dien, S.Kom., M.T.'],
            ['email' => 'afif@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Muhammad Afif Hendrawan., S.Kom., M.T.'],
            ['email' => 'deddy@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Deddy Kusbianto PA, Ir., M.Mkom.'],
            ['email' => 'rakhmat@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Rakhmat Arianto, S.ST., M.Kom., Dr.'],
            ['email' => 'anugrah@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Anugrah Nur Rahmanto, S.Sn., M.Ds.'],
            ['email' => 'farid@polinema.ac.id', 'password' => bcrypt('dosen123'), 'nip' => '00000000', 'name' => 'Farid Angga Pribadi, S.Kom., M.T.'],

            // Dont change rooms above
            // Put the new rooms bellow

        ]);
    }
}
