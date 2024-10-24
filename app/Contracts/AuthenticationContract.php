<?php

namespace App\Contracts;

use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\AuthenticationLoginRequest;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\AuthenticationUpdateRequest;
use App\Http\Requests\UserPostRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

interface AuthenticationContract
{
    function authenticate(array $request);
}
