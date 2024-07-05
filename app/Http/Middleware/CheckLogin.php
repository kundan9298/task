<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


// use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response | RedirectResponse

    {
       
        if (!$request->session()->has('loginId')) {
            return redirect('/')->with('fail', 'You must be logged in to access this page.');
        }
        return $next($request);
    }
}
