<?php

namespace App\Http\Middleware\api\Grade;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SameGradeMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
