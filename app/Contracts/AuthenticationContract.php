<?php

namespace App\Contracts;
use Illuminate\Http\Request;

interface AuthenticationContract
{
    function authenticate(array $request);
    function refreshToken(Request $request);
}
