<?php

namespace App\Services;

use App\Contracts\AuthenticationContract;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Resources\ApiResource;
use App\Models\User;
use App\Utils\WebResponseUtils;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;


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
            return WebResponseUtils::base(null, 'Failed to refreh token', 500);
        }
    }


    public function passwordEmail(ForgotPasswordRequest $request)
    {
        try {
            // Find the user by NIM and birth_date
            $user = DB::table('users')
            ->where('nim', $request->nim)
                ->where('birth_date', $request->birth_date)
                ->select('id', 'email')
                ->first();

            if (!$user) {
                // Handle the case when the user is not found
                throw new Exception("NIM atau Tanggal Lahir Salah");
            }

            // Generate a random password
            $newPassword = Str::random(12);

            // Update the password in the database
            DB::table('users')
            ->where('id', $user->id)
                ->update(['password' => Hash::make($newPassword)]);

            // Send the new password to the user's email
            Mail::to($user->email)->send(new \App\Mail\NewPasswordMail($newPassword));
            return new ApiResource(true, 'Password has been reset and sent to your email.',null);
        } catch (Exception $e) {
            return WebResponseUtils::base($e->getMessage(), 'Failed to reset password', 500);
        }
    }
}
