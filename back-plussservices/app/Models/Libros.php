<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libros extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'titulo',
        'image',
        'categoria_id',
        'descripcion',
        'fecha_lanzamiento',
        'disponibilidad_fisica',
        'disponibilidad_digital',
    ];
}
