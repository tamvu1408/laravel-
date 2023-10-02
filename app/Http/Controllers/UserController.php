<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->authorizeResource(User::class, 'user');
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
        $departments = $this->userRepository->create();

        return view('employee.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        if (!$request->validated()) {
            return redirect()->back()->withInput();
        }
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $storedPath = $image->move('avatars', $image->getClientOriginalName());
            $data['avatar'] = $storedPath;
        }

        $this->userRepository->store($data);

        return redirect()->back()->with('success', 'Thêm thành công !');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
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
        if (!$request->validated()) {
            return redirect()->back()->withInput();
        }
        $this->userRepository->update($user->id, $request->all());

        return redirect()->back()->with('success', 'Chỉnh sửa thành công !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->userRepository->delete($user->id);

        return redirect()->back()->with('success', 'Xóa ' . $user->name . ' thành công!');
    }

    public function getProfile()
    {
        $user  = $this->userRepository->getProfile();
        $departments = $this->userRepository->create();
        return view('employee.profile', compact('user', 'departments'));
    }

    public function changeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $storedPath = $image->move('avatars', $image->getClientOriginalName());
            $this->userRepository->changeAvatar($storedPath);
        }
        return redirect()->back();
    }
}
