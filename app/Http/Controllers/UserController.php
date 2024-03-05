<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('admin.users.create');
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Meng-hash password dengan Bcrypt
        $user->save();
    
        return redirect()->route('wherever')->with('success', 'User has been created successfully.');
    }

    // Menampilkan daftar user
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }
}
