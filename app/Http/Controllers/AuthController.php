<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'full_name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'requaired',
        ],  [
            'full_name.required' => 'Full Name wajib di isi',
            'username.required' => 'Username wajib di isi',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password wajib di isi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sesuai',
            'role.required' => 'user'
        ]);

        $data = [
            'full_name' => $request->full_name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ];

        User::create($data);

        return redirect('/login');
    }

    public function showLoginForm() {
        return view('login');
    }

    public function login(Request $request) {
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    
    if (auth()->attempt(['username' => $request->username, 'password' => $request->password])) {
        session(['username' => $request->username]);

        if (auth()->user()->role === 'user') {
            return redirect('/beranda');
        } else {
            return redirect('/admin.dashboard');
        }

        return back()->withErrors(['message' => 'Invalid credentials']);
    }
    }
    
    public function logout(Request $request) {
        Auth::logout(); 

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}