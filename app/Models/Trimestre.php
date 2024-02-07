<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_inicio_trimestre',
        'fecha_fin_trimestre',
    ];

    public function curs()
    {
        return $this->belongsTo(Curs::class);
    }
}

