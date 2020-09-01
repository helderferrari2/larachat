<?php

namespace App\Traits;

trait ResponseTrait
{

    /**
     * Default response for success request.
     *
     * @param  array  $data
     * @param  int    $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($data = [], $status = 200)
    {
        $response = [
            'status' => $status,
            'data' => $data
        ];
        return response()->json($response, $status);
    }

    /**
     * Default response for error request.
     *
     * @param  array  $errors
     * @param  int    $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $errors = [], $status = 400)
    {
        $response = [
            'status'  => $status,
            'message' => $message,
            'errors'  => $errors
        ];
        return response()->json($response, $status);
    }

    /**
     * Response for auth methods, return token in header
     *
     * @param  string  $token
     * @param  array   $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseWithToken($token, $data)
    {
        $json = [
            'status' => 200,
            'data' => $data,
        ];
        return response()->json($json)->header('Authorization', 'Bearer ' . $token);
    }
}
