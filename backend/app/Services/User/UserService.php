<?php

namespace App\Services\User;

use App\Models\User;

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
}
