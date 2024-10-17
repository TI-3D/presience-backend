<?php

namespace App\Services;

use App\Contracts\AuthenticationContract;
use App\Filament\Resources\StudentResource;
use App\Http\Requests\AuthenticationLoginRequest;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\AuthenticationUpdateRequest;
use App\Http\Resources\AuthenticationLoginResource;
use App\Http\Resources\GetDataResource;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function get(Request $request) :GetDataResource
    {

        try {
            $student = Auth::user();
            return new GetDataResource($student);
        } catch (\Exception $e) {
            throw new exception("Unauthorized Request");
        }
    }



}
