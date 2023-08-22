<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;
    protected $table = 'opiniones';
    protected $fillable = [
        'calificacion',
        'descripcion',
        'gimnasio_id',
        'user_id'
    ];
    public function gimnasio()
    {
        return $this->belongsTo(Gimnasio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
