<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $table = 'slot';
    protected $primaryKey = 'id_slot';
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_slot',
        'status',
        'id_lantai',
    ];
}
