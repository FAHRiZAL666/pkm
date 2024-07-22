<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kendaraan;
use App\Models\Slot;
use Carbon\Carbon;

class PembersihanOtomatis extends Command
{
    protected $signature = 'pembersihan:otomatis';
    protected $description = 'Membersihkan data kendaraan yang sudah melewati waktu booking';

    public function handle()
    {
        $kendaraan = Kendaraan::where('status', 'Booking')->get();

        foreach ($kendaraan as $data) {
            $jam_masuk = Carbon::parse($data->jam_masuk);
            $sekarang = Carbon::now('Asia/Jakarta');

            // Jika jam sekarang lebih besar dari jam masuk, hapus data
            if ($sekarang->gt($jam_masuk) && $sekarang->gt($sekarang->tanggal)) {
                $data->delete();

                // Update status slot menjadi Kosong
                Slot::where('id_slot', $data->id_slot)->update(['status' => 'Kosong']);

                $this->info("Data dengan ID {$data->id} dihapus karena melebihi waktu booking, dan status slot diupdate menjadi Kosong.");
            }
        }
    }
}
