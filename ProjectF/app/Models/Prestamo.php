<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $table = 'prestamos';

    protected $fillable = ['usuario_id', 'fecha_prestamo', 'fecha_devolucion', 'estado_id'];

    // Relación muchos a uno con usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    // Relación muchos a uno con estado de préstamo
    public function estado()
    {
        return $this->belongsTo(EstadoPrestamo::class, 'estado_id');
    }

    // Relación uno a muchos con detalles de préstamo
    public function detalles()
    {
        return $this->hasMany(DetallePrestamo::class);
    }

    // Relación muchos a muchos con libros (a través de detalles)
    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'detalleprestamos');
    }
}
