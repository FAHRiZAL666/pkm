<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parkiran;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Method untuk menampilkan halaman booking
    public function index()
    {
        $bookedSlots = Parkiran::where('status', 'Booking')->orWhere('status', 'Parkir')->pluck('slot_parkir')->toArray();
        return view('main', compact('bookedSlots'));  // Perbaiki view yang dirender
    }

    public function newStore(Request $request){
        $request->validate([
            'selectedSlot' => 'required|string',
        ]);
        $slots = $request->input('slot');
        $data = Parkiran::where('slot_parkir', $request->selectedSlot)->where('lantai', $request->selectedLantai)->first();
        if(!$data){
            $data = new Parkiran;
        }
        $data->user_id = Auth::id();
        $data->slot_parkir = $request->selectedSlot;
        $data->lantai = $request->selectedLantai;
        $data->jam_masuk = now();
        $data->jam_keluar = now()->addHours(2);
        $data->status = 'Booking';
        $data->save();

        return redirect()->route('karcis')->with('dataBooking', $data);
    }

    // Method untuk menampilkan halaman karcis
    public function showKarcis()
    {
        $dataBooking = session('dataBooking', []);
        return view('karcis', ['dataBooking' => $dataBooking]);
    }
}
