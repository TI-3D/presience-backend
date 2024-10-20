<?php

namespace App\Http\Middleware;

use App\Utils\WebResponseUtils;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class ApiMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (!Auth::user()) {
                return WebResponseUtils::base(["message" => "Unauthorized Request"], "Unauthorized Request", 401);
            }
        } catch (Exception $exception) {
            if ($exception instanceof TokenInvalidException) {
                return WebResponseUtils::base(["message" => "Token Invalid"], "Token Invalid", 401);
            } else if ($exception instanceof TokenExpiredException) {
                return WebResponseUtils::base(["message" => "Token Expired"], "Token Expired", 401);
            } else {
                return WebResponseUtils::base(["message" => "Unauthorized Request"], "Unauthorized Request", 401);
            }
        }

        return $next($request);
    }
}
