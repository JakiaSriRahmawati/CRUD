<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   
    public function dataUser(Request $request)
{
    $query = User::query();
    $search = $request->get('search', '');
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhereDate('tgl_lahir', '=', $search);
        });
    }
    $d = $query->paginate(5);
    $notFound = $d->isEmpty();
    return view('dataUser', compact('d', 'search', 'notFound'));
}

    // private function redirectUser($user)
    // {
    //     switch ($user->role) {
    //         case 'Admin':
    //             return redirect()->route('homeAdmin')->with('notifikasi', 'Selamat Datang, ' . $user->name);
    //         case 'Pengguna':
    //             return redirect()->route('homePengguna')->with('notifikasi', 'Selamat Datang, ' . $user->name);
    //         case 'Owner':
    //             return redirect()->route('homeOwner')->with('notifikasi', 'Selamat Datang, ' . $user->name);
    //         case 'Mekanik':
    //             return redirect()->route('homeMekanik', ['id' => $user->id])->with('notifikasi', 'Selamat Datang, ' . $user->name);
    //         case 'Kasir':
    //             return redirect()->route('homeKasir', ['id' => $user->id])->with('notifikasi', 'Selamat Datang, ' . $user->name);
    //         default:
    //             return redirect()->route('login')->with('notifikasi', 'Peran tidak dikenali.');
    //     }
    // }

    public function homePengguna(){
        return view('homePengguna');
    }
    public function tambahData(){
        return view('tambahdata');   
    }

    public function postTambahUser(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|min:8',
            'tgl_lahir' => 'required|date',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt($validatedData['password']),
            'tgl_lahir' => $validatedData['tgl_lahir'],
        ]);

        Auth::login($user);
        return redirect()->route('dataUser')->with('notifikasi', 'Data Berhasil Ditambahkan');
    }

public function showDeletedUsers()
{
    $deletedUsers = User::onlyTrashed()->with('deletedByUser')->get();
    return view('deleted_users.index', compact('deletedUsers'));
}

public function softDeleteUser($id)
{
    $user = User::find($id); 
    if ($user) {
        $user->delete(); 
        return redirect()->route('dataUser')->with('success', 'Pengguna berhasil dihapus!');
    }
    return redirect()->route('dataUser')->with('error', 'Pengguna tidak ditemukan!');
}


    public function index(Request $request)
{
    $search = $request->get('search');
    $users = User::query();

    if ($search) {
        $users = $users->where('name', 'LIKE', "%{$search}%")
                       ->orWhere('email', 'LIKE', "%{$search}%")
                       ->orWhere('phone', 'LIKE', "%{$search}%")
                       ->orWhere('tgl_lahir', 'LIKE', "%{$search}%");
    }

    $d = $users->paginate(5);
    $notFound = $d->isEmpty();

    return view('dataUser', compact('d', 'search', 'notFound'));
}



public function restoreUser($id)
{
    $user = User::withTrashed()->find($id); 
    if ($user) {
        $user->restore();
        return redirect()->route('deletedUsers')->with('success', 'Pengguna berhasil dipulihkan!');
    }

    return redirect()->route('deletedUsers')->with('error', 'Pengguna tidak ditemukan!');
}

public function edit($id)
{
    $user = User::find($id);
    if (!$user) {
        return redirect()->route('dataUser')->with('error', 'Pengguna tidak ditemukan!');
    }
    return view('edit', compact('user'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'phone' => 'required|string|max:15',
        'tgl_lahir' => 'required|date',
    ]);

    $user = User::find($id);
    if ($user) {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->save();

        return redirect()->route('dataUser')->with('success', 'Data pengguna berhasil diupdate!');
    }

    return redirect()->route('dataUser')->with('error', 'Pengguna tidak ditemukan!');
}

}
