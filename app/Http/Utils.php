<?php

namespace App\Http;

class Utils {

    public static function responseJson(int $status, string $message, $data, int $statusHttp)
    { dd($status,$message,$data);
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $statusHttp);
    }
}