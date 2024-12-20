<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = ['contenido', 'usuario_id', 'comentable_id', 'comentable_type'];

    // Relación polimórfica
    public function comentable()
    {
        return $this->morphTo();
    }

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
