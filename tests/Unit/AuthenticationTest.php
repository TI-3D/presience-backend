<?php

namespace Tests\Unit;

use App\Models\Student;
use App\Models\User;
use Database\Seeders\StudentSeeder;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic unit test example.
     */


    public function testLoginSuccess()
    {
        $this->post('api/users/login', [
            'username' => '2241720001',
            'password' => 'asdfasdf',
        ])->assertStatus(200);
        $user = User::where('username', '2241720001')->first();
    }
}
