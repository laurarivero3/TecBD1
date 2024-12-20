<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['nombre', 'email', 'telefono'];

    // Relación uno a muchos con préstamos
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

    // Relación uno a muchos con sanciones
    public function sanciones()
    {
        return $this->hasMany(Sancion::class);
    }

    // Relación uno a muchos con reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    // Relación polimórfica con comentarios
    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }

    // Relación polimórfica con likes
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
