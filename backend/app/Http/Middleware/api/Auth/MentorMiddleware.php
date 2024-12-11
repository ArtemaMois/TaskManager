<?php

namespace App\Http\Middleware\api\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MentorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role->code != 'mentor' && Auth::user()->role->code != 'admin')
        {
            return response()->json(['error' => 'Недостаточно прав'], 403);
        }
        return $next($request);
    }
}
