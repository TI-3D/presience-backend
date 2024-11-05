<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Hamcrest\Core\HasToString;
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
        User::create([
            'username'   => '2241720207',
            'password'   => Hash::make(2241720207),
            'nim'        => '2241720207',
            'name'       => 'Ahmad Taufiq Hidayatulloh',
            'birth_date' => now()->subYears(20),
            'gender'     => 'male',
            'group_id'   => 4,
            'verified'   => false,
        ]);

        User::create([
            'username'   => '2241720168',
            'password'   => Hash::make(2241720168),
            'nim'        => '2241720168',
            'name'       => 'Lucky Kurniawan Langoday',
            'birth_date' => now()->subYears(20),
            'gender'     => 'male',
            'group_id'   => 4,
            'verified'   => false,
        ]);

        User::create([
            'username'   => '2241720036',
            'password'   => Hash::make(2241720036),
            'nim'        => '2241720036',
            'name'       => 'Putri Norchasana',
            'birth_date' => now()->subYears(20),
            'gender'     => 'female',
            'group_id'   => 4,
            'verified'   => false,
        ]);

        User::create([
            'username'   => '2241720082',
            'password'   => Hash::make(2241720082),
            'nim'        => '2241720082',
            'name'       => 'Raffy Jamil Octavialdy',
            'birth_date' => now()->subYears(20),
            'gender'     => 'male',
            'group_id'   => 4,
            'verified'   => true,
        ]);

        // Starting NIM
        // $startingNim = 2241720000;

        // for ($i = 1; $i <=3 ; $i++) {
        //     for ($j = 1; $j<= 5; $j++) {
        //         $nim = $startingNim + $j;
        //         User::create([
        //             'username'   => $nim,
        //             'password'   => Hash::make($nim),
        //             'nim'        => $nim,
        //             'name'       => 'Student ' . $nim,
        //             'birth_date' => now()->subYears(20),
        //             'gender'     => fake()->randomElement(['Male', 'Female']),
        //             'group_id'   => $i,
        //             'verified'   => true,
        //         ]);
        //     }
        //     // Update starting NIM for the next group
        //     $startingNim += 5;
        // }
    }
}
