<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->only(['email', 'password']);
        if (!Auth::attempt($data)) {
            return redirect()->back()->with('login_error', 'Email hoặc mật khẩu không chính xác!');
        }

        if (Auth::user()->role === config('constant.EMPLOYEE')) {
            return redirect()->route('employee.profile');
        }
        
        return redirect()->route('employee.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
