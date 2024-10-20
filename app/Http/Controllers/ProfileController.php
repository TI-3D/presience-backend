<?php

namespace App\Http\Controllers;

use App\Contracts\ProfileContract;
use App\Http\Resources\ApiResource;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    protected ProfileContract $profileContract;

    public function __construct(ProfileContract $profileContract)
    {
        $this->profileContract = $profileContract;
    }


    public function getProfile(Request $request)
    {
        try {
            $result = $this->profileContract->getProfile($request);
            return new ApiResource(true, 'Success', $result);
        } catch (Exception $e) {
            return new ApiResource(false, 'Profile not found', $e);
        }
    }
}
