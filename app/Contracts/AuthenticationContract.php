<?php

namespace App\Contracts;

use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Http\Request;

interface AuthenticationContract
{
    function authenticate(array $request);
    function refreshToken(Request $request);
    function passwordEmail(ForgotPasswordRequest $request);
}
