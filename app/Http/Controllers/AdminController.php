<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // Menampilkan daftar akun Admin
    public function index()
    {
        $admins = User::where('role', 'admin')
            ->latest()
            ->paginate(10);

        return view('admins.index', compact('admins'));
    }

    // Menampilkan form tambah Admin
    public function create()
    {
        return view('admins.create');
    }

    // Menyimpan akun Admin baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);

        return redirect()
            ->route('superadmin.admins.index')
            ->with('success', 'Akun Admin berhasil ditambahkan.');
    }

    // Menampilkan form edit Admin
    public function edit(User $admin)
    {
        abort_unless($admin->role === 'admin', 404);

        return view('admins.edit', compact('admin'));
    }

    // Memperbarui informasi Admin
    public function update(Request $request, User $admin)
    {
        abort_unless($admin->role === 'admin', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],
        ]);

        $admin->update($validated);

        return redirect()
            ->route('superadmin.admins.index')
            ->with('success', 'Data Admin berhasil diperbarui.');
    }

    // Menghapus akun Admin
    public function destroy(User $admin)
    {
        abort_unless($admin->role === 'admin', 404);

        $admin->delete();

        return redirect()
            ->route('superadmin.admins.index')
            ->with('success', 'Akun Admin berhasil dihapus.');
    }

    // Mereset password Admin
    public function resetPassword(Request $request, User $admin)
    {
        abort_unless($admin->role === 'admin', 404);

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $admin->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('superadmin.admins.index')
            ->with('success', 'Password Admin berhasil direset.');
    }
}
