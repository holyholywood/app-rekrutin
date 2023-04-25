<?php


namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

/**
 * Response Trait 
 */

trait  ResponseTraits
{

    public function sendResponse($payload, $statusCode = 200, $message = 'Success', $customFieldName = null, $customFieldValue = null)
    {

        $nullishCondition = $payload === null || $payload === [];
        $Response = response()->json([
            'status' => true,
            'status_code' => $nullishCondition ? 404 : $statusCode,
            'message' => $nullishCondition ? 'Not Found' : $message,
            'payload' => $payload,
        ], $nullishCondition ? 404 : $statusCode);

        if ($customFieldName && $customFieldName) {
            $Response = response()->json([
                'status' => true,
                'status_code' => $statusCode,
                'status_code' => $nullishCondition ? 404 : $statusCode,
                'message' => $nullishCondition ? 'Not Found' : $message,
                $customFieldName => $customFieldValue
            ], $statusCode);
        }

        return $Response;
    }

    public function sendError($errorCode = 400, $errorMessage = 'Error')
    {
        return response()->json([
            'status' => false,
            'status_code' => $errorCode,
            'message' => $errorMessage,
        ], $errorCode);
    }
}
