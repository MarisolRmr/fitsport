<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gimnasios extends Model
{
    use HasFactory;
    protected $table = 'gimnasios';
    protected $fillable = [
        'nombre',
        'telefono',
        'horario',
        'horarioCierre',
        'descripcion',
        'longitud',
        'latitud',
        'fotografia',
    ];
    // En el modelo Gimnasio
    public function entrenadores()
    {
        return $this->hasMany(Entrenador::class, 'gimnasio_id');
    }
}