<?php

namespace App\Http\Middleware\api;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role->code != 'admin')
        {
            return response()->json(['error' => 'Недостаточно прав'], 403);
        }
        return $next($request);
    }
}
