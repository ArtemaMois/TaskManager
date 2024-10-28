<?php


namespace App\Services\Auth;

use App\Models\User;

class AuthService
{

    public function registerUser(array $data): User
    {
        $data['password'] = $this->getEncryptedPassword($data['password']);
        $user = User::query()->create($data);
        return $user;
    }

    private function getEncryptedPassword(string $password)
    {
        return bcrypt($password);
    }

    private function emailEvent($user)
    {

    }


}
