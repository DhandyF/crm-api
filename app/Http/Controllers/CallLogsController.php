<?php

namespace App\Http\Controllers;

use App\Models\CallLog;
use Illuminate\Http\Request;

class CallLogsController extends Controller
{
    public function add(Request $request)
    {
        $response = [
            'data' => [],
            'message' => '',
        ];
        $http_code = 200;

        try {
            $log = [
                'name' => $request->name ?? '',
                'phone' => $request->phone ?? '',
                'duration' => $request->duration ?? '',
                'status' => $request->status ?? '',
            ];

            $response['data'] = CallLog::create($log);
        } catch (\Exception $e) {
            $err_message = $e->getMessage();
            $response['message'] = $err_message;
            $http_code = $e->getCode() ?: 400;
        }
        return response()->json($response, $http_code);
    }

    public function get_list(Request $request)
    {
        $response = [
            'data' => [],
            'message' => '',
        ];
        $http_code = 200;

        try {
            $response['data'] = CallLog::get();
        } catch (\Exception $e) {
            $err_message = $e->getMessage();
            $response['message'] = $err_message;
            $http_code = $e->getCode() ?: 400;
        }
        return response()->json($response, $http_code);
    }
}
