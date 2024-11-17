<?php

namespace App\Services\User;

use App\Events\UpdateUserEvent;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\FileBag;

class UserService
{
    public function getUserByEmail(string $email, $default = null): ?User
    {
        $user = User::query()->where('email', $email)->first();
        return $user instanceof User ? $user : $default;
    }

    public function addVerifiedEmailAt(string $email)
    {
        $user = $this->getUserByEmail($email);
        $user->update(['email_verified_at' => now()->toDateTimeString()]);
    }

    public function storeFile(UploadedFile $photo): string
    {
        $file = Storage::disk('public')->putFile('/uploads/users/', $photo);
        $fullPath= Storage::disk('public')->path($file);
        $resultPath = str_replace('//', '/', '/storage/' . explode('uploads', $fullPath)[1]);
        return $resultPath;
    }

    public function updatePassword(User $user, $password)
    {
        $password = bcrypt($password);
        $user->update([
            'password' => $password
        ]);
        return $user;
    }

    public function getUpdatedData(array $data, UploadedFile|null $file)
    {
        $data = $this->prepareUpdatedData($data, $file);
        return $data;
    }

    private function prepareUpdatedData(array $data, UploadedFile|null $file)
    {
        $userData = $data;
        unset($userData['about_me']);
        $userData['photo_url'] = is_null($file) ? null : $this->storeFile($file);
        Auth::user()->role->code == 'mentor' ? event(new UpdateUserEvent($data)) : null;
        return $userData;
    }


}
