<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sancion extends Model
{
    use HasFactory;

    protected $table = 'sanciones';

    protected $fillable = ['usuario_id', 'motivo', 'monto', 'fecha_sancion'];

    // Relación muchos a uno con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
