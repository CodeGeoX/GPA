<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $fillable = ['nom_modul', 'id_cicle'];

    public function uf()
    {
        return $this->hasMany(Uf::class, 'id_modul');
    }

    public function cicle()
    {
        return $this->belongsTo(Cicle::class, 'id_cicle');
    }
}