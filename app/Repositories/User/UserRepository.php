<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Department;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        $users = User::paginate(10);

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

    public function getProfile()
    {
        return Auth::user();
    }

    public function changeAvatar($filePath)
    {
        // $user = Auth::user();
        $user = new User();
        $user->find(Auth::id());
        $user->avatar = $filePath;
        $user->save();
    }
}
