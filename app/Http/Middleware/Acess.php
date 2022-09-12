<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class Acess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //dd($request->bearerToken());
        //$request->headers('Authorization', 'Bearer '.$request->bearerToken());
        if($request->header('Authorization') == 'Bearer '.$request->bearerToken() )
        {

            return $next($request);
        }elseif($request->header('Authorization') != 'Bearer '.$request->bearerToken() ){
            abort(response()->json(
                [
                    'status' => false,
                    'message' => 'UnAuthenticated',
                ], 401));
        }elseif (Auth::guard('api')->check() != true) {
            abort(response()->json(
                [
                    'status' => false,
                    'message' => 'Unauthorized',
                ], 401));
        }
    }
}
