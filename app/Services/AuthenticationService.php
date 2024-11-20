<?php

namespace App\Services;

use App\Contracts\AuthenticationContract;
use App\Http\Resources\ApiResource;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationService implements AuthenticationContract
{
    public function authenticate(array $request)
    {
        try {
            $student = User::where('username', $request['username'])->first();
            if (
                !$student || !Hash::check($request['password'], $student->password)
            ) {
                throw new Exception("Username or Password Incorrect");
            }

            $token = Auth::guard('api')->attempt($request);
            if (!$token) {
                throw new exception("Unauthorized Request");
            }

            $expirationDate = Carbon::now()->addDays(7);

            $newRefToken = Str::uuid()->toString();
            $reftoken = DB::table('tokens')->insert([
                'student_id' => $student->id,
                'reftoken' => $newRefToken,
                'expired_at' => $expirationDate,
            ]);
            $insertedToken = DB::table('tokens')
                ->where('reftoken', $newRefToken)
                ->first();
            return [
                "token" => $token,
                "expired_in" => Auth::guard('api')->factory()->getTTL() * 60,
                "reftoken" => $insertedToken->reftoken,
                "expired_at" => $insertedToken->expired_at,
            ];
        } catch (Exception $e) {
            return $e;
        }
    }

    public function refreshToken(Request $request)
    {
        try {
            $reftoken = $request->input('reftoken');
            $token = DB::table('tokens')->where('reftoken', $reftoken)->first();
            if (!$token) {
                throw new Exception("Unauthorized Request");
            }

            if (Carbon::parse($token->expired_at)->isPast()) {
                DB::table('tokens')->where('reftoken', $reftoken)->delete();
                throw new Exception("Token expired");
            }

            $user = User::find($token->student_id);
            if (!$user) {
                throw new Exception("User not found");
            }
            $newAccessToken = JWTAuth::fromUser($user);
            return new ApiResource(true, 'Access token refreshed successfully', [
                'access_token' => $newAccessToken,
            ]);
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to refresh token', $e->getMessage());
        }
    }
}
