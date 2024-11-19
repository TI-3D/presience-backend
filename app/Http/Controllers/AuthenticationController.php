<?php

namespace App\Http\Controllers;

use App\Contracts\AuthenticationContract;
use App\Http\Requests\AuthenticationLoginRequest;
use App\Utils\WebResponseUtils;
use Exception;
use Illuminate\Http\Request;

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
            $payload = $request->validated();
            $result = $this->authenticationContract->authenticate($payload);
            return WebResponseUtils::response($result, "Login Success");
        } catch (Exception $e) {
            return $e;
        }
    }

    public function refToken(Request $token)
    {

        $result = $this->authenticationContract->refreshToken($token);
        return $result;
    }
}
