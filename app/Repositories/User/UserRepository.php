<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository
{
    public function findById(int $id): ?User
    {
        return User::query()
            ->where(User::ID_COLUMN, $id)
            ->first();
    }
}