<?php

namespace App\Helper;

class ApiResponse
{
    public static function success(
        $message = null,
        $data = [],
        $statusCode = 200
    ) {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public static function error(
        $message = null,
        $errors = [],
        $statusCode = 500
    ) {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }
}