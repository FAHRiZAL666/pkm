<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    use HasFactory;

    protected $table = 'lantai';
    protected $primaryKey = 'id_lantai';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_lantai',
        'denah',
        'id_mall'
    ];
}
