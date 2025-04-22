<?php 

namespace App\Services\Role;

use App\Models\Role;
use App\Models\User;

class RoleService
{
    public function updateUserRole(int $user_id, string $role)
    {
        $roleId = $this->getRoleId($role);
        $user = $this->getUser($user_id);
        return $user->update([
            'role_id' => $roleId
        ]);
    }

    private function getRoleId(string $roleCode)
    {
        $role = Role::firstWhere('code', $roleCode);
        return $role->id;
    }

    public function getUser(int $userId): User|null
    {
        return User::firstWhere('id', $userId);
    }
}