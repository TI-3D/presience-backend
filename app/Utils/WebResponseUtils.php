<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;
use Exception;

class WebResponseUtils
{

    public static function base($data, $message = '', $status = 200): JsonResponse
    {
        return response()->json([
            "message" => $message,
            "data" => $data,
        ], $status);
    }

    public static function response($result, $messageSuccess = '', $paginate = false): JsonResponse
    {
        if ($result instanceof Exception) {
            return WebResponseUtils::base(["message" => $result->getMessage()], $result->getMessage(), 400);
        } else {
            return WebResponseUtils::base($result, $messageSuccess);
        }
    }

    public static function exportResponse($result)
    {
        if ($result instanceof Exception) {
            return WebResponseUtils::base(["message" => $result->getMessage()], $result->getMessage(), 400);
        } else {
            return $result;
        }
    }

    public static function importResponse($result, $messageSuccess = ''): JsonResponse
    {
        if ($result instanceof Exception) {
            return WebResponseUtils::base(["message" => $result->getMessage()], $result->getMessage(), 400);
        } else {
            return WebResponseUtils::base([], $messageSuccess);
        }
    }
}