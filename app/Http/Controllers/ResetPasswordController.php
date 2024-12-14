<?php

namespace App\Http\Controllers;

use App\Contracts\AuthenticationContract;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Resources\ApiResource;
use Illuminate\Http\Request;
use App\Models\User;
use Cloudinary\Api\ApiResponse;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


use function Laravel\Prompts\error;

class ResetPasswordController extends Controller
{
    //
    protected AuthenticationContract $authenticationContract;

    public function __construct(AuthenticationContract $authenticationContract)
    {
        $this->authenticationContract = $authenticationContract;  // Correct assignment
    }


    public function passwordEmail(ForgotPasswordRequest $request)
    {
        $result = $this->authenticationContract->passwordEmail($request);
        return $result;
    }

}
