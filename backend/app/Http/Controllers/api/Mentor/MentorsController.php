<?php

namespace App\Http\Controllers\api\Mentor;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\Mentor\MentorResource;
use App\Models\Mentor;
use Illuminate\Http\Request;

class MentorsController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'success', 'mentors' => MentorResource::collection(Mentor::all())]);
    }

    public function delete(Mentor $mentor)
    {
        $mentor->delete();
        return response()->noContent();
    }
}
