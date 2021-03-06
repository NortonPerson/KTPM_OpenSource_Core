<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class CheckPostMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->has('token')){
            return response()->json(
                [
                    'error' => ['message' => 'not_token']
                ]
            ,200);
        }
        try {
            $user = JWTAuth::parseToken()->toUser();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(
                [
                    'error' => ['message' => 'token_expired']
                ]
                ,200);
        }
       
        return $next($request);
    }
}
