<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin'); // Ganti 'auth:admin' dengan middleware yang sesuai
    }
    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function dashboard()
    {
        // Ambil data yang diperlukan untuk dashboard, misalnya jumlah user
        $userCount = User::count();

        return view('admin.dashboard', compact('userCount'));
    }

    public function showUsers()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            // Jika sukses, redirect ke lokasi yang diinginkan
            return redirect()->intended('/admin/dashboard');
        }

        // Jika gagal, kembali ke halaman login dengan input lama dan pesan error
        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Credentials do not match our records.',
        ]);
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.showUsers')->with('success', 'User has been added successfully.');
    }

    // Tambahkan fungsi lain sesuai kebutuhan
}
