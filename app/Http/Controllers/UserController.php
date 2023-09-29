<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userRepository->getAll();

        return view('employee.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $departments = $this->userRepository->create();

        return view('employee.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $this->authorize('create', User::class);

        if ($request->validated()) {
            $this->userRepository->store($request->all());

            return redirect()->back()->with('success', 'Thêm thành công !');
        } else {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        $departments = $this->userRepository->create();

        return view('employee.show', compact('user', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, User $user)
    {
        $this->authorize('update', $user);
        if ($request->validated()) {
            $this->userRepository->update($user->id, $request->all());

            return redirect()->back()->with('success', 'Chỉnh sửa thành công !');
        } else {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $this->userRepository->delete($user->id);

        return redirect()->back()->with('success', 'Xóa ' . $user->name . ' thành công!');
    }
}
