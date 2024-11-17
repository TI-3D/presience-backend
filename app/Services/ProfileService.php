<?php

namespace App\Services;

use App\Contracts\ProfileContract;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Resources\ApiResource;
use App\Models\Group;
use App\Models\Photo;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileService implements ProfileContract
{
    public function getProfile(Request $request)
    {
        try {
        $student = Auth::user();
        $jurusan = "";
        if (isset($student->group_id)) {
            $group = Group::find($student->group_id);
            if ($group && isset($group->name)) {
                if (str_contains($group->name, 'TI')) {
                    $jurusan = "Teknik Informatika";
                } elseif (str_contains($group->name, 'SIB')) {
                    $jurusan = "Sistem Informasi Bisnis";
                }
            }
        }
        $data = [
            'student' => $student,
            'jurusan' => $jurusan
        ];
            return new ApiResource(true, 'Success', $data);
        } catch (Exception $e) {
            return new ApiResource(false, 'Profile not found', $e);
        }
        }

    public function storePhoto(StorePhotoRequest $request, int $id)
    {
        try {
            $student = User::find($id);
            if ($student && $student->verified) {
                $photos = Photo::where('student_id', $id)->get();
                return new ApiResource(true, 'Student is already verified.', $photos);
            } else {
        $uploadedPhotos = [];
        for ($i = 1; $i <= 5; $i++) {
            $photoField = 'photo' . $i;
            $image = $request->file($photoField);
            $cloudinaryImage = $image->storeOnCloudinary('photosML');
            $uploadedPhotos["photo$i"] = $cloudinaryImage->getSecurePath();
            $uploadedPhotos["image_public_id$i"] = $cloudinaryImage->getPublicId();
        }
        $photoUpload = Photo::create(array_merge([
            'student_id' => $id,
        ], $uploadedPhotos));
        $student = User::find($id);
        if ($student) {
            $student->verified = true;
            $student->save();
        }
                return new ApiResource(true, 'Photos uploaded successfully.', $photoUpload);
            }
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to upload photos', $e->getMessage());
        }
    }

    public function changePassword(User $student, ChangePasswordRequest $request)
    {
        try {
            $student->password = Hash::make($request->input('new_password'));
            $student->save();
            return new ApiResource(true, 'Password change successfully.', null);
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to change password', $e->getMessage());
        }
    }

    public function updateFcmId(string $fcmId)
    {
        try {
            $validator = Validator::make(
                ['fcm_id' => $fcmId],
                ['fcm_id' => 'required|string']
            );

            if ($validator->fails()) {
                return new ApiResource(false, 'Validation failed', $validator->errors());
            }

            $student = Auth::user();
            $student->fcm_id = $fcmId;
            $student->save();

            return new ApiResource(true, 'FCM ID change successfully.', [
                'username' => $student->username,
                'nim' => $student->nim,
                'name' => $student->name,
                'fcm_id' => $student->fcm_id,
                'gender' => $student->gender,
                'verified' => $student->verified,
                'semester' => $student->semester,
                'group_id' => $student->group,
            ]);
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to change FCM ID', $e->getMessage());
        }
    }
}
