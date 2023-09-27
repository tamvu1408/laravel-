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

        if (Auth::attempt($data)) {
            return redirect()->route('employee.index');
        } else {
            return redirect()->back()->with('login_error', 'Email hoặc mật khẩu không chính xác!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
