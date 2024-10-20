<?php

namespace App\Services;

use App\Contracts\ProfileContract;
use App\Models\Group;
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
}
