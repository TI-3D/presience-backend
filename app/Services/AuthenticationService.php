<?php

namespace App\Services;

use App\Contracts\AuthenticationContract ;
use App\Http\Requests\AuthenticationLoginRequest;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Resources\AuthenticationLoginResource;
use App\Models\Student;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticationService implements AuthenticationContract
{
    public function authenticate(AuthenticationLoginRequest $request): AuthenticationLoginResource
    {
        $data = $request->validated();
        $student = Student::where('username', $data['username'])->first();
        if (
            !$student || !Hash::check($data['password'], $student->password)
        ) {
            throw new HttpResponseException(response([
                'errors' => [
                    'message' => ["Username atau password salah"]
                ]
            ], 401));
        }

        $student->token = Str::uuid()->toString();
        $student->save();

        //Disini return statusnya 200 jadi tipe returnnya bisa menggunakan resource
        return new  AuthenticationLoginResource($student);
    }
}
