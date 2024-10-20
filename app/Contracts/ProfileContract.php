<?php

namespace App\Contracts;
use Illuminate\Http\Request;

interface ProfileContract
{
    function getProfile(Request $request);
}
