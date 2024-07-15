<?php

// BookingController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parkiran;

class BookingController extends Controller
{
    // Method untuk menampilkan halaman booking
    public function index()
    {
        $bookedSlots = Parkiran::where('status', 'Booking')->orWhere('status', 'Parkir')->pluck('slot_parkir')->toArray();
        return view('booking', compact('bookedSlots'));
    }

    // Method untuk menyimpan data booking dan menampilkan halaman karcis
    public function store(Request $request)
    {
        $request->validate([
            'slot.*' => 'required|string',
        ]);

        $slots = $request->input('slot');
        $user_id = Auth::id();
        $lantai = 'B1'; // Sesuaikan dengan lantai yang dipilih
        $dataBooking = []; // Untuk menyimpan data booking

        foreach ($slots as $slot) {
            $booking = Parkiran::create([
                'user_id' => $user_id,
                'lantai' => $lantai,
                'slot_parkir' => $slot,
                'jam_masuk' => now(),
                'jam_keluar' => now()->addHours(2), // Contoh: 2 jam ke depan
                'status' => 'Booking',
            ]);

            $dataBooking[] = $booking;
        }

        // Mengarahkan ke halaman karcis dengan data booking
        return redirect()->route('karcis')->with('dataBooking', $dataBooking);
    }

    // Method untuk menampilkan halaman karcis
    public function showKarcis()
    {
        $dataBooking = session('dataBooking', []);
        return view('karcis', ['dataBooking' => $dataBooking]);
    }
}
