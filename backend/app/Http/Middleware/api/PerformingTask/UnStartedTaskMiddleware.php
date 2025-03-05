<?php

namespace App\Http\Middleware\api\PerformingTask;

use App\Models\PerformingTask;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UnStartedTaskMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $task = $request->input('task');
        $performing_task = PerformingTask::query()
        ->where('task_id', $task)
        ->where('user_id', Auth::user()->id)->first();
        if(!is_null($performing_task))
        {
            return response()->json(['status' => 'failed', 'message' => 'Вы уже выполняете или выполнили эту задачу!'], 400);
        }
        return $next($request);
    }
}
