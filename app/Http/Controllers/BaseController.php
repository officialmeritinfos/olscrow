<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendError($error, $errorMessages,$code=404): JsonResponse
    {
        $response = [
            'error' => true,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response);
    }
    public function sendResponse($result, $message,$code=200): JsonResponse
    {
        $response = [
            'error'   => 'ok',
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }
}
