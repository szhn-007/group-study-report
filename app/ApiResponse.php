<?php

namespace App;

trait ApiResponse
{
    public function success(
        $status = true,
        $message = '',
        $result = [],
        $code = 200
    )
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'result' => $result,
            'code' => $code
        ], $code);
    }

    public function error(
        $status = false,
        $message = '',
        $result = [],
        $code = 500
    )
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'result' => $result,
            'code' => $code
        ], $code);
    }
}
