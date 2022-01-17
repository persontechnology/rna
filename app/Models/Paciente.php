<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = [
        'apellidos',
        'nombres',
        'cedula',
        'edad'
    ];

    public function historiales()
    {
        return $this->hasMany(Historial::class);
    }
}
