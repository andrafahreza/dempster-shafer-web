<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private function sendResponse(String $msg, bool $isErrors = false, $datas = null, int $statusCode = 200){
        $returns = [
            "result"     => $isErrors ? "error" : "success",
            "statusCode" => $statusCode,
            "title"      => $msg
        ];

        if($datas){
            $returns["data"] = $datas;
        }

        return response()->json($returns, 200);
    }

    public function sendError(String $msg, $datas = null, int $statusCode = 200){
        return $this->sendResponse($msg, true, $datas, $statusCode);
    }

    public function sendSuccess(String $msg, $datas = null, int $statusCode = 200){
        return $this->sendResponse($msg, false, $datas, $statusCode);
    }
}
