<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Department;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class UserRepository implements UserRepositoryInterface 
{
    private User $user;
    public function __construct(User $user) 
    {
        $this->user = $user;
    }

    public function getAll()
    {
        $users = [];
        if (Gate::allows('viewAny', User::class)) {
            $users = User::paginate(10);
        } else {
            $user = auth()->user();
            $users = collect([$user]);
        }

        return $users;
    }

    public function create()
    {
        $departments = Department::getList();

        return $departments;
    }

    public function store($user)
    {
        return $this->user->createUser($user);
    }

    public function update($userId, $userInfo)
    {
        return $this->user->findOrfail($userId)->updateUser($userInfo);
    }

    public function delete($userId)
    {
        return $this->user->destroy($userId);
    }
}