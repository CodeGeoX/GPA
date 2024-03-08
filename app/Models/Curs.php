<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curs extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_curs',
        'fecha_inicio_curs',
        'fecha_fin_curs',
    ];

    public function trimestres()
    {
        return $this->hasMany(Trimestre::class);
    }

    public function festius()
    {
        return $this->hasMany(Festiu::class);
    }

    public function cicles()
{
    return $this->hasMany(Cicle::class);
}
}
