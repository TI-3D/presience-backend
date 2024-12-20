<?php

namespace App\Services;

use App\Contracts\ProfileContract;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Resources\ApiResource;
use App\Models\Group;
use App\Models\User;
use App\Utils\WebResponseUtils;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class ProfileService implements ProfileContract
{
    private static string $flaskApiBaseUrl;
    private static int $faceUploadTimeout;

    public function __construct()
    {
        self::$flaskApiBaseUrl = env('FLASK_API_BASE_URL');
        self::$faceUploadTimeout = (int) env('FACE_UPLOAD_TIMEOUT'); // Default to 60 seconds
    }

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
            return WebResponseUtils::base(null, 'Profile Not Found', 500);
        }
    }

    public function faceRecognition(StorePhotoRequest $request)
    {
        try {
            $student = Auth::user();

            if (!$student || empty($student->face_embedding)) {
                return WebResponseUtils::base(
                    null,
                    'No face embedding found for this user',
                    400
                );
            }

            $image = $request->file('face_image');
            if (!$image->isValid()) {
                return WebResponseUtils::base(
                    null,
                    'Invalid image file',
                    400
                );
            }

            $response = $this->callFlaskApi(
                '/validate-face',
                $image,
                ['database_embedding' => base64_encode($student->face_embedding)]
            );

            $responseData = $response->json();

            return WebResponseUtils::base($responseData['data'], $responseData['message'], $response->getStatusCode());

        } catch (RequestException $e) {
            Log::error('Face recognition API error:', [
                'error' => $e->getMessage(),
                'response' => $e->response?->body()
            ]);
            return WebResponseUtils::base(null, 'Face recognition service unavailable', 503);

        } catch (Exception $e) {
            Log::error('Face recognition error:', ['error' => $e->getMessage()]);
            return WebResponseUtils::base(null, 'Failed to process face recognition', 500);
        }
    }

    public function storePhoto(StorePhotoRequest $request)
    {
        try {
            $student = Auth::user();

            if (!$student) {
                throw new Exception('Unauthorized request');
            }

            // if ($student->verified) {
            //     return WebResponseUtils::base(null, 'Student is already verified', 403);
            // }

            $image = $request->file('face_image');
            if (!$image->isValid()) {
                return WebResponseUtils::base(
                    null,
                    'Invalid image file',
                    400
                );
            }

            $response = $this->callFlaskApi('/face-recognition/add', $image);
            $responseData = $response->json();

            if ($response->getStatusCode() != 200) {
                return WebResponseUtils::base($responseData['data'], $responseData['message'], $response->getStatusCode());
            }

            if (!isset($responseData['data']['face_embedding_blob'])) {
                throw new Exception('Invalid response from face recognition service');
            }

            // Store face embedding and update verification status
            $student->face_embedding = base64_decode($responseData['data']['face_embedding_blob']);
            $student->verified = true;
            $student->save();

            // Store image on Cloudinary
            $image->storeOnCloudinary('photosML');

            return new ApiResource(true, 'Photos uploaded and verification completed successfully.', null);

        } catch (RequestException $e) {
            Log::error('Face embedding API error:', [
                'error' => $e->getMessage(),
                'response' => $e->response?->body()
            ]);
            return WebResponseUtils::base(null, 'Face recognition service unavailable', 503);

        } catch (Exception $e) {
            Log::error('Photo storage error:', ['error' => $e->getMessage()]);
            return WebResponseUtils::base(null, 'Failed to process and store photo', 500);
        }
    }

    private function callFlaskApi(string $endpoint, $image, array $additionalData = [])
    {
        return Http::timeout(self::$faceUploadTimeout)
            ->withHeaders([
                'Accept' => 'application/json',
                'X-API-Key' => env('FLASK_API_KEY'),
            ])
            ->attach(
                'face_image',
                file_get_contents($image->getPathname()),
                $image->getClientOriginalName()
            )
            ->post(self::$flaskApiBaseUrl . $endpoint, $additionalData);
    }

    public function validatePassword(string $password)
    {
        try {
            $validator = Validator::make(
                ['password' => $password],
                ['password' => 'required|string|min:8']
            );

            if ($validator->fails()) {
                return WebResponseUtils::base($validator->errors(), 'Validation failed', 400);
            }

            $student = Auth::user();
            $student = User::where('id', $student->id)->first();

            if (!Hash::check($password, $student->password)) {
                return WebResponseUtils::base(null, 'Password not match', 400);
            }
            return WebResponseUtils::base(null, 'Validate password success', 200);
        } catch (Exception $e) {
            return WebResponseUtils::base($e->getMessage(), 'Failed to validate password', 500);
        }
    }

    public function changePassword(User $student, ChangePasswordRequest $request)
    {
        try {
            $student->password = Hash::make($request->input('new_password'));
            $student->save();
            return new ApiResource(true, 'Password change successfully.', null);
        } catch (Exception $e) {
            return WebResponseUtils::base(null, 'Failed to change password', 500);
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
                return WebResponseUtils::base($validator->errors(), 'Validation failed', 400);
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
            return WebResponseUtils::base(null, 'Failed to change FCM ID', 500);

        }
    }
}
