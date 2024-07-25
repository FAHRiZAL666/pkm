<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Kendaraan;
use App\Models\Slot;

class CheckExpiredBookings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $kendaraan = Kendaraan::where('status', 'Booking')->get();

        foreach ($kendaraan as $data) {
            $jam_masuk = Carbon::parse($data->jam_masuk);
            $sekarang = Carbon::now('Asia/Jakarta');

            // Jika jam sekarang lebih besar dari jam masuk, hapus data
            if ($sekarang->gt($jam_masuk)) {
                $data->delete();

                // Update status slot menjadi Kosong
                Slot::where('id_slot', $data->id_slot)->update(['status' => 'Kosong']);
            }
        }

        return $next($request);
    }
}
