<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    // Relación polimórfica
    public function likeable()
    {
        return $this->morphTo();
    }

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
