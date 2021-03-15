<?php

namespace App\Traits;

trait AppResponse
{
    public function coreResponse($message, $data = null, $statusCode, $isSuccess = true)
    {
        if($isSuccess) {
            return response()->json([
                'code' => $statusCode,
                'message' => $message,
                'status' => true,
                'data' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'code' => $statusCode,
                'message' => $message,
                'status' => false,
            ], $statusCode);
        }
    }
    
    public function success($message, $data = null)
    {
        return $this->coreResponse($message, $data, 200);
    }
    
    public function error($message, $statusCode = 201)
    {
        return $this->coreResponse($message, null, $statusCode, false);
    }
}