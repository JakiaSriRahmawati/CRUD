<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        $user = Auth::user();
        return view('login', compact('user'));
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
            if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->route('dataUser');
        }
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }


    public function register() {
        return view('register');
    }
    public function postRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'password' => 'required|min:8',
            'tgl_lahir' => 'nullable|date',
        ]);
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt($validatedData['password']),
            'tgl_lahir' => $validatedData['tgl_lahir'],
        ]);
        return redirect()->route('dataUser'); 
    }


    public function logout() {
        auth()->logout();
        return redirect()->route('homePengguna');
    }
}
