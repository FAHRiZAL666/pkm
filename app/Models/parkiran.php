<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parkiran extends Model
{
    use HasFactory;
    protected $table = 'parkirans';
    protected $guarded = ['id'];
}
