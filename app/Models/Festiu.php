<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festiu extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_inicio_festiu',
        'fecha_fin_festiu',
        'curs_id'
    ];

    protected $dates = [
        'fecha_inicio_festiu',
        'fecha_fin_festiu',
    ];

    public function curs()
    {
        return $this->belongsTo(Curs::class);
    }
}
