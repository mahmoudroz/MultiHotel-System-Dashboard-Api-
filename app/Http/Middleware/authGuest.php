<?php

namespace App\Http\Middleware;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use response;
class authGuest
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
        try {
            config(['auth.defaults.guard' => 'guest']);
            $user = JWTAuth::parseToken()->authenticate();
            $token = JWTAuth::getToken();
            $payload = JWTAuth::getPayload($token)->toArray();
            if ($payload['type'] != 'guest') {
                return response()->json([
                    'status'=>false,
                    'message'=>__('site.Not authorized'),
                ],404);
            }
        } catch (Exception $e) {
            if ($e instanceof  TokenInvalidException) {
                return response()->json([
                    'status'=>false,
                    'message'=>__('site.Token is Invalid'),
                ],404);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json([
                    'status'=>false,
                    'message'=>__('site.Token is Expired'),
                ],404);
            }
            else if ($e instanceof TokenBlacklistedException) {
                return response()->json([
                    'status'=>false,
                    'message'=>__('site.Token is blacklist'),
                ],404);
            }
            else {
                return response()->json([
                    'status'=>false,
                    'message'=>__('site.Authorization Token not found'),
                ],404);
            }
        }

        return $next($request);
    }
}
