<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
     {

    // Check if user is logged in AND is an admin
    
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request); // Allow access
    }

    // If not admin, redirect to homepage with error message
    return redirect('/')->with('error', 'Access denied. Admin only.');
}
}
