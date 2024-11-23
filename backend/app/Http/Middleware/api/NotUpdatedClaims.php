<?php

namespace App\Http\Middleware\api;

use App\Models\Claim;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotUpdatedClaims
{

    public function handle(Request $request, Closure $next): Response
    {
        $claim = Claim::find($request->segment(count($request->segments())))->first();
        if($claim->claimStatus->code != 'handle')
        {
            return response()->json(['error' => "Заявка уже обновлена"], 400);
        }
        return $next($request);
    }
}
