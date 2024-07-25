<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\User;
use App\Models\Slot;
use Illuminate\Http\Request;

class RFIDController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'uid' => 'string',
        ]);

        // Cari user berdasarkan UID
        $user = User::where('uid', $request->uid)->first();
        $kendaraan = Kendaraan::where('id_user', $user->id_user)->where('status', 'Booking')->first();
        $slot = Slot::where('id_slot', $kendaraan->id_slot)->first();

        if ($user && $kendaraan && $slot) {
            $kendaraan->jam_masuk = now()->setTimezone('Asia/Jakarta');
            $kendaraan->tanggal = date('Y-m-d');
            $kendaraan->status = 'Dalam Parkiran';
            $kendaraan->save();

            $slot->status = 'Terisi';
            $slot->save();

            return  "Berhasil masuk parkiran";
        }
        return  "Gagal Masuk Parkiran";
    }

    public function update(Request $request)
    {
        $request->validate([
            'uid' => 'required|string|size:8',
        ]);

        $user = User::where('uid', $request->uid)->first();
        $kendaraan = Kendaraan::where('id_user', $user->id_user)->where('status', 'Dalam Parkiran')->whereNull('jam_keluar')->first();
        $slot = Slot::where('id_slot', $kendaraan->id_slot)->first();

        if (!$user) {
            return response()->json(['message' => 'User dengan UID tersebut tidak ditemukan'], 404);
        }

        if (!$kendaraan) {
            return response()->json(['message' => 'Tidak ada kendaraan dengan id_user tersebut yang belum memiliki jam_keluar'], 404);
        }

        $kendaraan->jam_keluar = now()->setTimezone('Asia/Jakarta');
        $kendaraan->status = 'Keluar Parkiran';
        $kendaraan->save();

        $slot->status = 'Kosong';
        $slot->save();

        return response()->json(['message' => 'Jam keluar berhasil diperbarui'], 200);
    }
}
