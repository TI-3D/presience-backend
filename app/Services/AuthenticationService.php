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
        try{
        $student = User::where('username', $request['username'])->first();
        if (
            !$student || !Hash::check($request['password'], $student->password)
        ) {
            throw new Exception("Username or Password Incorrect");
        }
        $token = Auth::guard('api')->attempt($request);
        if (!$token) {
            throw new exception("Unauthorized Request");
        }
        return [
            "token" => $token,
            "expired_in" => Auth::guard('api')->factory()->getTTL() * 60,
        ];
    } catch(Exception $e){
        return $e;
    }
    }



}
