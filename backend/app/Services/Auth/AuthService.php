<?php


namespace App\Services\Auth;

use App\Events\api\Auth\UserCreatedEvent;
use App\Models\User;

class AuthService
{

    public function registerUser(array $data): User
    {
        $data['password'] = $this->getEncryptedPassword($data['password']);
        $data['role_id'] = 3;
        $user = User::query()->create($data);
        $this->emailEvent($user);
        return $user;
    }

    private function getEncryptedPassword(string $password)
    {
        return bcrypt($password);
    }

    private function emailEvent(User $user)
    {
        event(new UserCreatedEvent($user));
    }


}
