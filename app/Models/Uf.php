<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_uf',
        'hores_dilluns',
        'hores_dimarts',
        'hores_dimecres',
        'hores_dijous',
        'hores_divendres',
        'id_modul',
    ];

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'id_modul');
    }
}