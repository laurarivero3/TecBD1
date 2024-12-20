<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePrestamo extends Model
{
    use HasFactory;

    protected $table = 'detalleprestamos';

    // Relación muchos a uno con préstamo
    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }

    // Relación muchos a uno con libro
    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
}
