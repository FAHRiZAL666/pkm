<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parkiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lantai',
        'slot_parkir',
        'jam_masuk',
        'jam_keluar',
        'status',
    ];
}
