<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    use HasFactory;
    protected $table = 'mall';
    protected $primaryKey = 'id_mall';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_mall',
        'gambar'
    ];
    
}
