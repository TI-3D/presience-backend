<?php

namespace App\Http\Controllers;

use App\Contracts\ProfileContract;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Resources\ApiResource;
use App\Models\Photo;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function storePhotos(StorePhotoRequest $request)
    {
        try {
            $studentId = Auth::id();
            $user = User::find($studentId);
            if ($user && $user->verified) {
                $photos = Photo::where('student_id', $studentId)->get();
                return new ApiResource(true, 'Student is already verified.', $photos);
            } else {
                $result = $this->profileContract->storePhoto($request,$studentId);
                return new ApiResource(true, 'Photos uploaded successfully.', $result);
            }
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to upload photos', $e->getMessage());
        }
    }

}
