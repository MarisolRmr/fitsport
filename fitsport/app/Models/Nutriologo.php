<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutriologo extends Model
{
    use HasFactory;
    protected $table = 'nutriologo';
    protected $fillable = [
        'nombre',
        'telefono',
        'horaEntrada',
        'horaSalida',
        'cedula',
        'longitud',
        'latitud',
        'imagen',
    ];
}
