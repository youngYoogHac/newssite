<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('main')->with('success', 'Вы вошли в систему.');
        }

        return back()
            ->withErrors(['login' => 'Неверный логин или пароль.'])
            ->withInput($request->only('login'));
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'login'    => 'required|string|max:255|unique:users,login',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $userRole = Role::query()->where('name', 'user')->firstOrFail();

        $user = User::create([
            'name'     => $validated['name'],
            'login'    => $validated['login'],
            'password' => $validated['password'],
            'role_id'  => $userRole->id,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('main')->with('success', 'Регистрация завершена.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('main')->with('success', 'Вы вышли из системы.');
    }
}