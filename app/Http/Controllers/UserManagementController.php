<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserManagementController extends Controller
{

    public function index(Request $request)
    {
        // Ambil semua filter dari request
        $filters = $request->only(['name', 'email', 'role', 'regional']);

        // Buat query untuk data pengguna
        $query = User::query();

        // Terapkan filter jika tersedia
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (!empty($filters['role'])) {
            $query->where('role', $filters['role']);
        }

        if (!empty($filters['regional'])) {
            $query->where('regional', $filters['regional']);
        }

        // Ambil hasil filter dengan pagination
        $users = $query->distinct()->paginate(10);

        // Ambil nama role untuk setiap pengguna
        foreach ($users as $user) {
        $user->role = $user->roles->pluck('name')->first(); // Ambil nama role pertama
    }

        // Kirim data ke view
        return view('users.users', compact('users', 'filters'));
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,user',
            'regional' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'regional' => $request->regional, // Pastikan field 'role' ada di tabel 'users'
        ]);

        // Menetapkan role ke pengguna menggunakan Spatie
        $user->assignRole($request->role);  // Menetapkan role yang dipilih

        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
    // Mendapatkan role pengguna dengan Spatie
    $role = $user->roles->first()->name; // Ambil role pertama jika hanya ada satu role
    return view('users.edit', compact('user', 'role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required',
            'regional' => 'required|string',
            'role' => 'required|string|in:admin,user',  // Pastikan validasi role
        ]);

        $user = User::findOrFail($id);

        // Update informasi dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->regional = $request->regional;

        // Cek apakah password diubah
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan pada pengguna
        $user->save();

        // Tentukan role baru untuk pengguna menggunakan Spatie's method
        $user->syncRoles($request->role);  // Menggunakan syncRoles untuk memperbarui role

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        Log::info('Request Data:', $request->all());

        $ids = $request->input('ids');

        if (!empty($ids)) {
            User::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Selected User deleted successfully.');
        }

        return redirect()->back()->with('error', 'No User selected.');
    }
}
