<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $fillable = [
        'pulso_cardiaco',
        'paciente_id',
        'estado',
    ];

    protected $casts = [
        'created_at' => 'date:m-d-Y H:m',
    ];
}
