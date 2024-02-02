<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festiu extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_inicio_festiu',
        'data_final_festiu',
    ];

    public function curs()
    {
        return $this->belongsTo(Curs::class);
    }

    public function festius()
    {
        return $this->hasMany(Festiu::class);
    }

}
