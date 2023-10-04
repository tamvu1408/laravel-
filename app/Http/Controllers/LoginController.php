<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $data = $request->only(['email', 'password']);
            if (!Auth::attempt($data)) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Unauthorized!'
                ]);
            }
            $user = Auth::user();
            if ($user instanceof \App\Models\User) {
                $token = $user->createToken('authToken')->plainTextToken;
            }

            return response()->json([
                'status' => 200,
                'message' => 'Login success!',
                'token' => $token,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Login fail!',
                'error' => $e,
            ]);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        $user()->tokens()->delete();
    }
}
