<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //dd($request->bearerToken());
        if (! $request->expectsJson()) {
            abort(response()->json(
                [
                    'status' => false,
                    'message' => 'Unauthorized',
                ], 401));
        }
        if (Auth::guard('api')->check() != true) {
            abort(response()->json(
                [
                    'status' => false,
                    'message' => 'Unauthorized',
                ], 401));
        }
        if($request->header('Authorization') != 'Bearer '.$request->bearerToken() ){
            abort(response()->json(
                [
                    'status' => 'error',
                    'message' => 'UnAuthenticated',
                ], 401));
        }
    }
}
