<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function home()
    {
        return view('index');
    }

    public function authenticate(AdminLoginRequest $request)
    {
        try {
            $remember_me = $request->has('remember_me') ? true : false;
            $user = Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember_me);
            $request->session()->regenerate();

            if (auth()->user()->role == 'admin') {
                return redirect()->intended(route('admin.home'));
            } elseif (auth()->user()->role == 'agent') {
                return redirect()->intended(route('agent.home'));
            } else {
                return redirect()->intended(route('user.home'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('message.invalid_login'));
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('words.something_wrong'));
        }
    }
}
