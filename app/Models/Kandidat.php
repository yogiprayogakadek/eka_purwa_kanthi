<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;

    protected $table = 'kandidat';
    protected $primaryKey = 'id_kandidat';
    protected $guarded = ['id_kandidat'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pemilu()
    {
        return $this->belongsTo(Pemilu::class, 'id_pemilu');
    }
}
