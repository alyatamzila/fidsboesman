<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Tampilkan semua admin
    public function index()
    {
        $admins = User::where('role', 'admin')->paginate(5);
        return view('admin.index', compact('admins'));
    }

    // Form tambah admin
    public function create()
    {
        return view('admin.create');
    }

    // Simpan data admin baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin has been successfully added.');
    }

    // Form edit admin
    public function edit($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    // Update data admin
    public function update(Request $request, $id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Admin has been updated.');
    }

    // Hapus admin
    public function destroy($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin has been deleted.');
    }
}
