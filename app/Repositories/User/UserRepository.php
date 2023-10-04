<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Department;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        $users = User::paginate(10, ['id', 'email', 'username', 'birth_date', 'gender', 'status', 'role']);
        return $users;
    }
}
