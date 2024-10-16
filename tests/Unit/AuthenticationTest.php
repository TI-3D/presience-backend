<?php

namespace Tests\Unit;

use App\Models\Student;
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
        $user = Student::where('username', '2241720001')->first();
        self::assertNotNull($user->token);
    }

    public function testLoginFailed()
    {
        $this->post('api/users/login', [
            'username' => '2241720000',
            'password' => '2241720001',
        ])->assertStatus(401)
            ->assertJson(
                [
                    'errors' => [
                        "message" => ["Username atau password salah"]
                    ]
                ]
            );
    }
    public function testLoginPasswordWrong()
    {
        $this->post('api/users/login', [
            'username' => '2241720001',
            'password' => 'salah',
        ])->assertStatus(401)
            ->assertJson(
                [
                    'errors' => [
                        "message" => ["Username atau password salah"]
                    ]
                ]
            );
    }

}
