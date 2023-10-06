<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'libro_id',
        'tipo_libro',
    ];


    public function users()
    {
        return $this->belongsTo(User::class,'id');
    }

    public function libros()
    {
        return $this->belongsTo(Libros::class,'id');
    }

    public static function existeRenta($user_id, $libro_id)
    {
        return self::where('user_id', $user_id)
            ->where('libro_id', $libro_id)
            ->exists();
    }

    public static function buscarRentaPorUsuarioYLibro($user_id, $libro_id)
    {
        return self::where('user_id', $user_id)
        ->where('libro_id', $libro_id)
        ->first();
    }

}
