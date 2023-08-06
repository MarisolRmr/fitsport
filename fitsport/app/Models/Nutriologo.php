<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutriologo extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'horaEntrada',
        'horaSalida',
        'cedula',
        'longitud',
        'latitud',
        'fotografia',
        'tipo_id'
    ];
}
