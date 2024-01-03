<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        // get logged in user to check role
        $user = $request->user();

        // check if user has admin role
        if (!$user || !$user->hasRole('admin')) {
            // redirect to home page
            return redirect()->route('home');
        }

        // else continue with request
        return $next($request);
    }
}
