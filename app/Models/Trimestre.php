<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    use HasFactory;

    protected $casts = [
        'fecha_inicio_trimestre' => 'datetime',
        'fecha_fin_trimestre' => 'datetime',
        'curs_id'
    ];
    protected $dates = ['fecha_inicio_trimestre', 'fecha_fin_trimestre']; 
    public function curs()
    {
        return $this->belongsTo(Curs::class);
    }
}

