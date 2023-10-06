<?php

namespace App\Http\Controllers;

use App\Models\Libros;
use App\Models\Rentas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RentasController extends Controller
{



    public function rentarLibro(Request $request, Libros $libro){
        $tipoLibro = $request->tipo_libro;
        $user_id= $request->user()->id;
        $libro_id=$libro->id;
        $request->validate([
            'tipo_libro' => [
                'required',
                Rule::in(['fisico', 'digital']), // Asegura que el tipo sea uno de estos dos
            ],
        ]);

        // Consultar la disponibilidad del libro desde la base de datos
        //$libro = Libros::find($libroId);

        if (!$libro) {
            return response()->json(['error' => 'Libro no encontrado'], 404);
        }


        $renta= new Rentas();
        if($renta->existeRenta( $user_id, $libro_id)){
            return response()->json(['error' => 'Ud. ya ha rentado este libro'], 404);
        }

        $renta->user_id=$user_id;
        $renta->libro_id=$libro_id;
        $renta->tipo_libro=$tipoLibro;

        if ($tipoLibro === 'fisico' && $libro->disponibilidad_fisica > 0) {
            $libro->disponibilidad_fisica--;
            $libro->save();
            $renta->save();
            return response()->json(['message' => 'Libro fisico rentado exitosamente']);
        } elseif ($tipoLibro === 'digital' && $libro->disponibilidad_digital > 0) {
            $libro->disponibilidad_digital--;
            $renta->save();
            $libro->save();
            return ['message' => 'Libro digital rentado exitosamente'];
        } else {
            return response()->json(['error' => 'No hay disponibilidad para este tipo de libro'], 400);
        }
    }

    public function devolderLibro(Request $request, Libros $libro){
        $user_id= $request->user()->id;
        $libro_id=$libro->id;

        // Consultar la disponibilidad del libro desde la base de datos
        //$libro = Libros::find($libroId);

        if (!$libro) {
            return response()->json(['error' => 'Libro no encontrado'], 404);
        }

        $renta_temp= new Rentas();
        if(!$renta_temp->existeRenta( $user_id, $libro_id)){
            return response()->json(['error' => 'Ud. no ha rentado este libro'], 404);
        }

        $renta=$renta_temp->buscarRentaPorUsuarioYLibro($user_id, $libro_id);

        $tipoLibro = $renta->tipo_libro;

        if ($tipoLibro === 'fisico' && $libro->disponibilidad_fisica >= 0) {
            $libro->disponibilidad_fisica++;
            $libro->save();
            $renta->delete();
            return response()->json(['message' => 'Libro fisico devuelto exitosamente']);
        } elseif ($tipoLibro === 'digital' && $libro->disponibilidad_digital >= 0) {
            $libro->disponibilidad_digital++;
            $libro->save();
            $renta->delete();
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
        /*
        $User = User::find(1);
        return [
            'renta' => $User,
            'libro' => $User->libros_rentados,
        ];
        $libro = Libros::find(1);

        return [
            'libro' => $libro,
            'categoria' => $libro->categoria,
            'renta_usuarios' => $libro->rentas_users,
        ];*/

        $Rentas = Rentas::find(1);
        return [
            'renta' => $Rentas,
            'libro' => $Rentas->libros,
            'usuario' => $Rentas->users,
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
        return [
            'renta' => $request->user()
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rentas $rentas)
    {

    }
}
