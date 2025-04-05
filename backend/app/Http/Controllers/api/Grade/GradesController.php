<?php

namespace App\Http\Controllers\api\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\Grade\StoreGradeRequest;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradesController extends Controller
{
    public function store(StoreGradeRequest $request)
    {
        $grade = Grade::query()->create([
            'mentor_id' => $request->input('mentor_id'),
            'user_id' => Auth::user()->id,
            'grade' => $request->input('grade')
        ]);
        return response()->json(['status' => 'success', 'grade' => $grade]);
    }

}
