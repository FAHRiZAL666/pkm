<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();
        $title = 'Daftar User'; // Definisikan variabel $title di sini
        return view('user', compact('users', 'title')); // Sertakan $title
    }

    public function store(Request $request)
    {
        $request->validate([
            'uid' => 'required|unique:users,uid',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5',
        ]);

        Users::create([
            'uid' => $request->uid,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function update(Request $request, $id_user)
    {
        $request->validate([
            'uid' => 'required|unique:users,uid,' . $id_user . ',id_user',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id_user . ',id_user',
            'password' => 'nullable|string|min:6',
        ]);

        $user = Users::findOrFail($id_user);

        $user->uid = $request->uid;
        $user->nama = $request->nama;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(Users $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
