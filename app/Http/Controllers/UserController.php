<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        $users = [];
        if (Gate::allows('viewAny', User::class)) {
            $users = User::all();
        } else {
            $user = auth()->user();
            $users = collect([$user]);
        }

        return view('employee.index', compact('users'));
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        $departments = Department::getList();

        return view('employee.show', compact('user', 'departments'));
    }

    public function update(EmployeeRequest $request, User $user)
    {
        $this->authorize('update', $user);
        if ($request->validated()) {
            $user->updateUser($request->all());

            return redirect()->back()->with('success', 'Chỉnh sửa thành công !');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function delete(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();

        return redirect()->back()->with('success', 'Xóa ' . $user->name . ' thành công!');
    }
}
