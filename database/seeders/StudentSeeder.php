<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Hamcrest\Core\HasToString;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Starting NIM
        $startingNim = 2241720000;
        $totalStudents = 378;
        $studentsPerClass = 27;
        $totalClasses = (int) ceil($totalStudents / $studentsPerClass); // Hitung jumlah kelas

        $currentNim = $startingNim;

        for ($class = 1; $class <= $totalClasses; $class++) {
            // Tentukan jumlah mahasiswa untuk kelas ini
            $studentsInClass = ($class == $totalClasses) ? $totalStudents - ($studentsPerClass * ($totalClasses - 1)) : $studentsPerClass;

            for ($i = 1; $i < $studentsInClass; $i++) {
                // Buat mahasiswa
                User::create([
                    'username'   => $currentNim,
                    'password'   => Hash::make($currentNim),
                    'email'      => fake()->unique()->safeEmail(),
                    'nim'        => $currentNim,
                    'name'       => fake()->name(),
                    'birth_date' => now()->subYears(20),
                    'gender'     => fake()->randomElement(['Male', 'Female']),
                    'group_id'   => $class,  // Asumsikan group_id berdasarkan kelas
                    'verified'   => false,
                ]);

                // Inkrementasi NIM untuk mahasiswa berikutnya
                $currentNim++;
            }

            // Jika jumlah mahasiswa sudah mencapai totalStudents, keluar dari loop
            if ($currentNim - $startingNim >= $totalStudents) {
                break;
            }
        }

        User::where('username', '2241720207')->update(['name' => 'Ahmad Taufiq Hidayatulloh', 'gender' => 'Male', 'email' => 'hidayatullohtaufiq0@gmail.com']);
        User::where('username', '2241720168')->update(['name' => 'Lucky Kurniawan Langoday', 'gender' => 'Male', 'email' => 'luckykurniawan656@gmail.com']);
        User::where('username', '2241720036')->update(['name' => 'Putri Norchasana', 'gender' => 'Female','email'=>'putrinorchasana@gmail.com']);
        User::where('username', '2241720082')->update(['name' => 'Raffy Jamil Octavialdy', 'gender' => 'Male', 'email' => 'rafiteguh6@gmail.com']);
    }
}
