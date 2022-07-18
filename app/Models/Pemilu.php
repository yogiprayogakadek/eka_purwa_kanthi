<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilu extends Model
{
    use HasFactory;

    protected $guarded = ['id_pemilu'];
    protected $table = 'pemilu';
    protected $primaryKey = 'id_pemilu';

    public function kandidat()
    {
        return $this->hasMany(Kandidat::class, 'id_pemilu');
    }
}
