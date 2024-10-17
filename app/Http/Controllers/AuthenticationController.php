<?php

namespace App\Http\Controllers;

use App\Contracts\AuthenticationContract;
use App\Filament\Resources\StudentResource;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AuthenticationLoginRequest;
use App\Http\Resources\AuthenticationLoginResource;
use App\Http\Resources\GetDataResource;
use App\Models\Student;
use App\Utils\WebResponseUtils;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
            $payload = $request->validated();
            $result = $this->authenticationContract->authenticate($payload);
            return WebResponseUtils::response($result, "Login Success");
        } catch (Exception $e) {
            return $e;
        }
    }

    public function get(Request $request)
    {
        try {
            $result = $this->authenticationContract->get($request);
            return $result;
        } catch (Exception $e) {
            return $e;
        }
    }
}
