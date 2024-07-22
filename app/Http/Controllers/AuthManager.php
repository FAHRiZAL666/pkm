<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Kendaraan;
use App\Models\Mall;
use App\Models\Lantai;
use App\Models\Slot;
use App\Models\Admin;


class AuthManager extends Controller
{
    function login()
    {
        return view('login');
    }

    function admin()
    {
        // Admin::create([
        //     'username' => 'admin',
        //     'password' => Hash::make('parkcamemotrack'),
        // ]);
        // return 'success';
        return view('admin');
    }

    function registration()
    {
        return view('registration');
    }

    function home()
    {
        $data = [
            'mall' => Mall::all(),
        ];
        return view('home', $data);
    }

    // function main()
    // {
    //     $data = [
    //         'mall' => Mall::all(),
    //         'lantai' => Lantai::all(),
    //         'slot' => Slot::all(),
    //         'bookedSlots' => Kendaraan::whereIn('status', ['Booking', 'Dalam Parkiran'])->pluck('id_slot')->toArray(),
    //     ];
    //     return view('main', $data);
    // }

    function karcis()
    {
        return view('karcis');
    }

    public function adminPost(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Mencari pengguna berdasarkan username
        $user = Admin::where('username', $request->username)->first();

        // Memeriksa apakah pengguna ditemukan dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            // Membuat session untuk pengguna
            Session::put('username', $user->username);
            Session::put('role', 'admin');

            // Redirect ke halaman yang dituju
            return redirect()->intended(route('dashboard'));
        }

        // Jika login gagal, redirect kembali ke halaman login dengan pesan error
        return redirect(route('admin'))->with("error", "Login details are not valid");
    }


    public function loginPost(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // Mencari pengguna berdasarkan email dan password teks biasa

        if ($user && Hash::check($request->password, $user->password)) {
            // Membuat session untuk pengguna
            Session::put('id_user', $user->id_user);
            Session::put('uid', $user->uid);
            Session::put('email', $user->email);
            Session::put('nama_user', $user->nama_user);
            Session::put('role', 'user');

            // Redirect ke halaman yang dituju
            return redirect()->intended(route('home'));
        }

        // Jika login gagal, redirect kembali ke halaman login dengan pesan error
        return redirect(route('login'))->with("error", "Login details are not valid");
    }


    function registrationPost(Request $request)
    {
        $request->validate([
            'uid' => 'required',
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['uid'] = $request->uid;
        $data['nama'] = $request->nama;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = Users::create($data);
        if (!$user) {
            return redirect(route('registration'))->with("error", "Registration failed, ty again");
        }
        return redirect(route('login'))->with("success", "Registration success, Login to the app");
    }

    function mainPost(Request $request)
    {
        $request->validate([
            'slot_parkir' => 'required',
        ]);

        $credentials = $request->only('slot_parkir');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('karcis'));
        }
    }

    function logout()
    {
        session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            $malls = Mall::all();
        } else {
            $malls = Mall::where('nama_mall', 'like', '%' . $keyword . '%')->get();
        }

        $formattedMalls = [];
        foreach ($malls as $mall) {
            $formattedMalls[] = [
                'name' => $mall->nama_mall,
                'image' => asset('images/mall/' . $mall->gambar),
            ];
        }

        return response()->json($formattedMalls);
    }
}
