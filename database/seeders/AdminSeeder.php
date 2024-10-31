<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('admin123'),
                'nip' => '1234567890',
                'name' => 'Admin1',
            ],
            [
                'email' => 'admin2@gmail.com',
                'password' => bcrypt('admin123'),
                'nip' => '0987654321',
                'name' => 'Admin2',
            ],
        ]);
    }
}
