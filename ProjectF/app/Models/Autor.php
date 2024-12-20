<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';
    
    protected $fillable = ['nombre', 'nacionalidad'];

    // Relación muchos a muchos con libros
    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'libros_autores');
    }
}
