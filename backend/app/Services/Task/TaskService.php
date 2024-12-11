<?php 

namespace App\Services\Task;

use Illuminate\Support\Facades\Auth;

class TaskService 
{
    public function getFormedData(array $validated)
    {
        $result = $this->collectData($validated);
        return $result;
    }

    public function collectData(array $data)
    {
        $mentor = Auth::user()->mentor;
        $result = [
            'title' => $data['title'],
            'description' => $data['description'],
            'mentor_id' => $mentor->id,
            'category_id' => $data['category']
        ];
        return $result;
    }

}