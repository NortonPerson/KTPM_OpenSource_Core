<?php

namespace App\Http\Controllers\ApiV2;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class HomeController extends Controller
{
    public function check(){
        $data = Carbon::now();
        $now = $data->timestamp;
        //$payload = JWTFactory::sub(['created_at' => $now->toDateTimeString(), 'time' => 5])->make();
        $payload = JWTFactory::make([
            'iss' => 'token_check_time_out',
            'iat' => $now,
            'exp' => $now + 300,
            'nbf' => $now,
            'sub' => 1,
            'jti' => md5('1'.$now)
        ]);
        $token = JWTAuth::encode($payload);
        return $this->api_response($token->get());
    }
}
