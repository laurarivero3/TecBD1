<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'libros';

    protected $fillable = ['titulo', 'isbn', 'fecha_publicacion', 'descripcion', 'categoria_id'];

    // Relación muchos a uno con Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relación muchos a muchos con autores
    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'libros_autores');
    }

    // Relación uno a muchos con editoriales
    public function editoriales()
    {
        return $this->hasMany(LibroEditorial::class);
    }

    // Relación uno a muchos con detalles de préstamo
    public function detallesPrestamo()
    {
        return $this->hasMany(DetallePrestamo::class);
    }
}
