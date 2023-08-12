<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'horaEntrada',
        'horaSalida',
        'email',
        'gimnasios_id',
        'fotografia',
        'tipo_id'
    ];
}
