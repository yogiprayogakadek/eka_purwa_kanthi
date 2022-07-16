<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $guarded = [
        'id_pengumuman',
    ];
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
}