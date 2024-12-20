<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    protected $table = 'editoriales';

    // Campos permitidos para asignación masiva
    protected $fillable = ['nombre', 'pais'];

    // Relación uno a muchos con libros
    public function libros()
    {
        return $this->hasMany(LibroEditorial::class);
    }
}
