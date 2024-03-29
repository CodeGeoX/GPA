<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curs extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_inicio_curs',
        'fecha_fin_curs',
    ];

    public function trimestres(){
        return $this->hasMany(Trimestre::class);
    }
}
