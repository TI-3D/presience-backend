<?php

namespace App\Contracts;

interface AuthenticationContract
{
    function authenticate(array $request);
}
