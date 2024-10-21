<?php

namespace App\Services;

use App\Contracts\ProfileContract;
use App\Http\Requests\StorePhotoRequest;
use App\Models\Group;
use App\Models\Photo;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileService implements ProfileContract
{
    public function getProfile(Request $request): array
    {
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
        return $data;
    }

    public function storePhoto(StorePhotoRequest $request, int $id)
    {
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
        return $photoUpload;
    }
}
