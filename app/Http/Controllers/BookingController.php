<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Mall;
use App\Models\Lantai;
use App\Models\Slot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    // Method untuk menampilkan halaman booking
    // public function index()
    // {
    //     $bookedSlots = Kendaraan::where('status', 'Booking')->orWhere('status', 'Parkir')->pluck('nama_slot')->toArray();
    //     return view('main', compact('bookedSlots'));  // Perbaiki view yang dirender
    // }

    function show($id_mall)
    {
        // Mendapatkan lantai pertama berdasarkan id_mall
        $lantai = Lantai::where('id_mall', $id_mall)->first();

        if ($lantai) {
            // Mengambil id_lantai pertama
            $id_lantai = $lantai->id_lantai;

            // Mengarahkan ke URL yang diinginkan
            return redirect()->route('home.mall.lantai', ['id_lantai' => $id_lantai]);
        } else {
            // Jika tidak ada lantai yang ditemukan, Anda bisa mengarahkan ke halaman lain atau menampilkan pesan error
            return redirect()->route('home.mall'); // Contoh: kembali ke halaman utama mall
        }
    }

    function lantai($id_lantai)
    {
        $data = [
            'mall' => Mall::all(),
            'lantai' => Lantai::all(),
            'slot' => Slot::all(),
            'lantaiSelected' => Lantai::where('id_lantai', $id_lantai)->first(),
        ];
        return view('main', $data);
    }

    public function newStore(Request $request)
    {
        $request->validate([
            'slot_id' => 'required|exists:slot,id_slot',
            'lantai_id' => 'required|exists:lantai,id_lantai',
            'mall_id' => 'required|exists:mall,id_mall',
        ]);

        $data = new Kendaraan;
        $data->id_user = Session::get('id_user');
        $data->id_slot = $request->slot_id;
        $data->id_lantai = $request->lantai_id;
        $data->id_mall = $request->mall_id;
        $data->jam_masuk = now('Asia/Jakarta')->addMinutes(15); // Tambah 15 menit
        $data->tanggal = date('Y-m-d');
        $data->status = 'Booking';
        $data->save();

        // Update status slot menjadi 'Terisi'
        $slot = Slot::find($request->slot_id);
        if ($slot) {
            $slot->status = 'Terisi';
            $slot->save();
        }
        // Tambahkan log ini untuk memastikan data disimpan
        if (!$data->id_user) {
            return redirect()->back()->with('error', 'Data tidak berhasil disimpan.');
        }

        return redirect()->route('karcis')->with('dataBooking', $data);
    }

    public function showKarcis()
    {
        $kendaraan = Kendaraan::where('id_user', Session::get('id_user'))
            ->where(function ($query) {
                $query->where('status', 'Booking')
                    ->orWhere('status', 'Dalam Parkiran');
            })
            ->get();
        $mall = Mall::all();
        $lantai = Lantai::all();
        $slot = Slot::all();

        return view('karcis', [
            'kendaraan' => $kendaraan,
            'mall' => $mall,
            'lantai' => $lantai,
            'slot' => $slot
        ]);
    }
}
