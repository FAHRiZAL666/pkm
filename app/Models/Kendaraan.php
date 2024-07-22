<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'jam_masuk',
        'jam_keluar',
        'tanggal',
        'status',
        'id_user',
        'id_slot',
        'id_lantai',
        'id_mall',
    ];
}
