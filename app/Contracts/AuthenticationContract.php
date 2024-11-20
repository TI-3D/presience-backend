<?php

namespace App\Contracts;

interface AuthenticationContract
{
    function authenticate(array $request);
    function refreshToken(Request $request);
}
