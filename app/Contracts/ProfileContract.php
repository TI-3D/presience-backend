<?php

namespace App\Contracts;

use App\Http\Requests\StorePhotoRequest;
use Illuminate\Http\Request;

interface ProfileContract
{
    function getProfile(Request $request);
    function storePhoto(StorePhotoRequest $request, int $id);
}
