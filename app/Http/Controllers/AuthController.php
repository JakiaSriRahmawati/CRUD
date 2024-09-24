<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthController extends Controller
{
    public function login()
    {
    return view('login'); 
    }

    public function postLogin(Request $request)
    {
    $request->validate([
        "email" => "required|email",
        "password" => "required",
    ]);
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return $this->redirectUser(auth()->user());
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
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }


    private function redirectUser($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('homeAdmin')->with('notifikasi', 'Selamat Datang, ' . $user->name);
            case 'pengguna':
                return redirect()->route('homePengguna')->with('notifikasi', 'Selamat Datang, ' . $user->name);
            }
    }




}
    