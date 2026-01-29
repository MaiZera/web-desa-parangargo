<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AccountController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.accounts.index', compact('users'));
    }

    public function create()
    {
        return view('admin.accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'access_level' => ['required', 'string', 'in:super_admin,admin,editor'],
        ]);

        User::create([
            'name' => $request->username,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'access_level' => $request->access_level,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.accounts.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function destroy(User $account)
    {
        if (User::count() <= 1) {
            return back()->with('error', 'Tidak dapat menghapus satu-satunya akun yang tersisa.');
        }

        if ($account->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri dari sini.');
        }

        $account->delete();

        return redirect()->route('admin.accounts.index')->with('success', 'Akun berhasil dihapus.');
    }
}
