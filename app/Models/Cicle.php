<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicle extends Model
{
    use HasFactory;

    protected $fillable = ['nom_cicle, id_curs'];

    public function moduls()
    {
        return $this->hasMany(Modul::class, 'id_cicle');
    }
    public function curs()
    {
        return $this->belongsTo(Curs::class, 'id_curs');
    }
}