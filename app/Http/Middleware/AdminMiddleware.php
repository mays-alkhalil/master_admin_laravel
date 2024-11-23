<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == '1') { // 1 هو أدمن
                return $next($request);
            } else {
                return redirect('/home')->with('message', 'Access Denied! You are not an admin.');
            }
        } else {
            return redirect('/login')->with('status', 'Please login to access the admin panel.');
        }
    }
        }

