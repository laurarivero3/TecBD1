<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = ['usuario_id', 'libro_id', 'fecha_reserva'];

    // Relación muchos a uno con usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    // Relación muchos a uno con libro
    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
}
