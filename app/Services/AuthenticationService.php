<?php

namespace App\Services;

use App\Contracts\AuthenticationContract;
use App\Models\User;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationService implements AuthenticationContract
{
    public function authenticate(array $request)
    {
        // $student = User::where('email', $request['email'])->first();
        $student = User::where('username', $request['username'])->first();
        if (
            !$student || !Hash::check($request['password'], $student->password)
        ) {
            throw new HttpResponseException(response([
                'errors' => [
                    'message' => ["Username atau password salah"]
            ]
            ], 401));
        }
        $token = Auth::guard('api')->attempt($request);
        if (!$token) {
            throw new exception("Unauthorized Request");
        }
        // dd($student);
        // Auth::login($student);

        //Disini return statusnya 200 jadi tipe returnnya bisa menggunakan resource
        return [
            "token" => $token,
            "expired_in" => Auth::guard('api')->factory()->getTTL() * 60,
        ];
    }



}
