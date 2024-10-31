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
        //
        // Starting NIM
        $startingNim = 2241720000;

        for ($i = 1; $i <=3 ; $i++) {
            for ($j = 1; $j<= 5; $j++) {
                $nim = $startingNim + $j;
                User::create([
                    'username'   => $nim,
                    'password'   => Hash::make($nim),
                    'nim'        => $nim,
                    'name'       => 'Student ' . $nim,
                    'birth_date' => now()->subYears(20),
                    'gender'     => fake()->randomElement(['Male', 'Female']),
                    'group_id'   => $i,
                    'verified'   => true,
                ]);
            }
            // Update starting NIM for the next group
            $startingNim += 5;
        }
    }
}
