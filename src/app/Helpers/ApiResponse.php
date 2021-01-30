<?php

namespace App\Helpers;

class ApiResponse
{
    /**
     * Defined success response format
     * @param $message
     * @param $response
     * @return \Illuminate\Http\JsonResponse
     */
    public static function successResponse($message, $response = null)
    {
        return response()->json([
        'status' => true,
        'message' => $message,
        'response' => $response
        ]);
    }

    /**
     * Defined failure response format
     * @param $message
     * @param $response
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function failureResponse($message, $response = null, $code = 403)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'response' => $response
        ], $code);
    }

    /**
     * Defined validation response
     * @param $message
     * @param $response
     * @return \Illuminate\Http\JsonResponse
     */
    public static function validationFailure($message, $response)
    {
        return response()->json([
        'status' => false,
        'message' => $message,
        'response' => $response
        ], 422);
    }
}
