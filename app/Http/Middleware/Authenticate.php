<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

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
        if (!$request->expectsJson()) {

            $currentMidleware = $request->route()->middleware();
            // dd($currentMidleware);
            if (!empty($currentMidleware) && in_array('auth:doctor', $currentMidleware)) {

                return route('doctor.login');
            }
            // dd(Auth::guard());
            return route('login');
        }
    }
}