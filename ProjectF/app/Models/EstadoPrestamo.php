<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPrestamo extends Model
{
    use HasFactory;

    protected $table = 'estadosprestamo';

    protected $fillable = ['nombre'];
}
