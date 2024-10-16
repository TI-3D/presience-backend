<?php

namespace App\Http\Controllers;

use App\Contracts\AuthenticationContract;
use App\Http\Requests\AuthenticationLoginRequest;
use App\Http\Resources\AuthenticationLoginResource;
use App\Models\Student;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{

    protected AuthenticationContract $authenticationContract;

    public function __construct(AuthenticationContract $authenticationContract)
    {
        $this->authenticationContract = $authenticationContract;  // Correct assignment
    }

    public function login(AuthenticationLoginRequest $request)
    {
        try {
            return $this->authenticationContract->authenticate($request);
        } catch (\Exception $e) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => ['Username atau password salah'],
                ]
            ], 401));
        }
    }
}
