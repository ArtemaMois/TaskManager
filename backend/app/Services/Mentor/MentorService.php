<?php 

namespace App\Services\Mentor;

use App\Models\Category;
use App\Models\Mentor;
use App\Models\User;

class MentorService
{
    public function createMentor(User $user, Category $category): Mentor

    {
        $mentor = Mentor::query()->create([
            'user_id' => $user->id,
            'login' => $user->login,
        ]);
        $mentor->categories()->attach($category->id);
        return $mentor;
    }

    public function editMentor(Mentor $mentor,array $data)
    {
        $mentor->update($data);
        return $mentor;
    }
}