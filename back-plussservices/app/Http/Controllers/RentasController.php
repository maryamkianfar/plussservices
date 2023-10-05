<?php

namespace App\Http\Controllers;

use App\Models\Libros;
use App\Models\Rentas;
use Illuminate\Http\Request;

class RentasController extends Controller
{



    public function rentarLibro(Request $request, Libros $libro){
        $libroId = $request->id;
        $tipoLibro = $request->tipo_libro;

        // Consultar la disponibilidad del libro desde la base de datos
        //$libro = Libros::find($libroId);

        if (!$libro) {
            return response()->json(['error' => 'Libro no encontrado'], 404);
        }

        //Se revisa que no exista
        /*$existeRegistro = Rentas::where('user_id', 1)
        ->where('libro_id', $libro->id)
                            ->exists();
        if($existeRegistro){
            return response()->json(['error' => 'Ud. ya ha rentado este libro'], 404);

        }*/

        if ($tipoLibro === 'fisico' && $libro->disponibilidad_fisica > 0) {

            $libro->disponibilidad_fisica--;
            $libro->save();
            return response()->json(['message' => 'Libro fisico rentado exitosamente']);
        } elseif ($tipoLibro === 'digital' && $libro->disponibilidad_digital > 0) {
            $libro->disponibilidad_digital--;
            $libro->save();
            return ['message' => 'Libro digital rentado exitosamente'];
        } else {
            return response()->json(['error' => 'No hay disponibilidad para este tipo de libro'], 400);
        }
    }

    public function devolderLibro(Request $request, Libros $libro){
        $tipoLibro = $request->tipo_libro;

        // Consultar la disponibilidad del libro desde la base de datos
        //$libro = Libros::find($libroId);

        if (!$libro) {
            return response()->json(['error' => 'Libro no encontrado'], 404);
        }

        //Se revisa que no exista
        /*$existeRegistro = Rentas::where('user_id', 1)
        ->where('libro_id', $libro->id)
                            ->exists();
        if($existeRegistro){
            return response()->json(['error' => 'Ud. ya ha rentado este libro'], 404);

        }*/

        if ($tipoLibro === 'fisico' && $libro->disponibilidad_fisica >= 0) {

            $libro->disponibilidad_fisica++;
            $libro->save();
            return response()->json(['message' => 'Libro fisico devuelto exitosamente']);
        } elseif ($tipoLibro === 'digital' && $libro->disponibilidad_digital >= 0) {
            $libro->disponibilidad_digital++;
            $libro->save();
            return ['message' => 'Libro digital devuelto exitosamente'];
        } else {
            return response()->json(['error' => 'No hay disponibilidad para este tipo de libro'], 400);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rentas $rentas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rentas $rentas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rentas $rentas)
    {
        //
    }
}
