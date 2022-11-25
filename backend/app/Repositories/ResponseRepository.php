<?php

namespace App\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseRepository
{
    /**
     * ResponseError
     * 
     * Returns the errors data if there is any error
     *
     * @param object $errors
     * @return Response
     */
    public static function ResponseError($errors, $message = 'Internal Server Error !', $status_code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
            'data' => null,
        ], $status_code);
    }

    /**
     * ResponseSuccess
     * 
     * Returns the success data and message if there is any error
     *
     * @param object $data
     * @param string $message
     * @param integer $status_code
     * @return Response
     */
    public static function ResponseSuccess($data, $message = "Successfull", $status_code = JsonResponse::HTTP_OK, $pagination = [])
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'errors' => null,
            'data' => $data,
            'pagination' => $pagination
        ], $status_code);
    }
}