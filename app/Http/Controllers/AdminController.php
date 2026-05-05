<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // Menampilkan daftar semua user
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admins.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        return view('admins.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,user',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admins.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    // Form edit user
    public function edit(User $admin) // parameter route model binding
    {
        return view('admins.edit', compact('admin'));
    }

    // Update user
    public function update(Request $request, User $admin)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($admin->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'required|in:admin,user',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $admin->update($validated);

        return redirect()->route('admins.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function destroy(User $admin)
    {
        // Mencegah admin menghapus dirinya sendiri (opsional)
        if ($admin->id === auth()->id()) {
            return redirect()->route('admins.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $admin->delete();

        return redirect()->route('admins.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
