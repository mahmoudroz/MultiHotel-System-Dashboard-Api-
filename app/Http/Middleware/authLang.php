<?php

namespace App\Http\Middleware;
use Closure;
use App;
use response;
class authLang
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
        App::setlocale('en');

        if($request->header('lang') != null)
        {
            App::setlocale($request->header('lang'));
        }
        if($request->header('Apipassword') != '1795S')
        {
            return response()->json([
                'status'=>false,
                'message'=>__("site.You Are Not Authorized"),
            ]);
        }
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('Access-Control-Allow-Methods', 'GET,HEAD,OPTIONS,POST,PUT"')
            ->header('Access-Control-Allow-Headers', 'Origin, Content-Type')
            ->header('Access-Control-Allow-Headers', 'Origin,Accept, Content-Type, Authorization');
    }
}
