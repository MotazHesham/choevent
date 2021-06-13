<?php

namespace App\Traits;

trait ResponseFormatTrait
{

    public function sendError($error, $errorMessages = [], $code = 404, $status)
    {
        $response = [
            'error' => true,
            'message' => $error,
            'status' => $status,

        ];

        if (!empty($errorMessages)) {
            $respone['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function sendResponse($result, $message)
    {
        $response = [
            'error' => false,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }
}
