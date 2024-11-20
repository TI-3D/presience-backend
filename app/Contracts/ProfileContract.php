<?php

namespace App\Contracts;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StorePhotoRequest;
use App\Models\User;
use Illuminate\Http\Request;

interface ProfileContract
{
    function getProfile(Request $request);
    function storePhoto(StorePhotoRequest $request);
    public function faceRecognition(StorePhotoRequest $request);
    public function changePassword(User $student, ChangePasswordRequest $request);
    public function updateFcmId(string $fcmId);
}
