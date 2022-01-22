<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MyTestMiddleware
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
        $path = $request->path();
        Log::info('MyTestMiddleware::handle called at path => '.$path);
        $secureCheck = true;
        if ($request->is('/') || $request->is('login3') || $request->is('dologin3') ||
            $request->is('usersrest') || $request->is('usersrest/*') ||
            $request->is('loggingservice')) {
            $secureCheck = false;
        }
        if($secureCheck) {
            Log::info("Leaving My Security Middleware in handle() doing a redirect back to login");
            return redirect('/login3');
        }


        return $next($request);
    }
}
