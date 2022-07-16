<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapat extends Model
{
    use HasFactory;

    protected $guarded = ['id_rapat'];
    protected $primaryKey = 'id_rapat';
    protected $table = 'rapat';
}
