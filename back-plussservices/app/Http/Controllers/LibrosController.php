<?php

namespace App\Http\Controllers;

use App\Http\Resources\LibroCollection;
use App\Models\Libros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LibrosController extends Controller
{

    public function revisarLocalidad(Request $request)
    {
        $localidad = $request->localidad;
        $nombre = $request->nombre;

        // Utiliza comillas dobles para que las variables se interpreten
        $url = "http://127.0.0.1/biblioteca/disponibilidad/$localidad/libro/$nombre";

        $response = Http::get($url);

        $data = $response->json();

        return [
            'data' => $data
        ];
    }

    public function filtrar(Request $request){
        // Inicializar la consulta con la condición de disponibilidad
        $query = Libros::where(function ($query) {
            $query->where('disponibilidad_fisica', '>', 0)
                ->orWhere('disponibilidad_digital', '>', 0);
        });

        // Aplicar filtro por titulo si se proporciona en la solicitud
        if ($request->has('titulo')) {
            $titulo = $request->titulo;
            $query->where('titulo', 'LIKE', "%$titulo%");
        }

        // Aplicar filtro por categoria_id si existe y no está vacío
        if ($request->filled('categoria_id')) {
            $categoria_id = $request->categoria_id;
            $query->where('categoria_id', $categoria_id);
        }

        // Ordenar por fecha de lanzamiento y luego alfabéticamente
        $libros = $query->orderBy('fecha_lanzamiento')
            ->orderBy('titulo')
            ->paginate(10);

        return $libros;




    }

    public function index()
    {
        return new LibroCollection(Libros::where(function($query) {
            $query->where('disponibilidad_fisica', '>', 0)
                  ->orWhere('disponibilidad_digital', '>', 0);
        })
        ->orderBy('fecha_lanzamiento', 'DESC')
        ->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string',
            //'image' => 'required|string',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'descripcion' => 'required|string',
            'fecha_lanzamiento' => 'required|date',
            'disponibilidad_fisica' => 'required|integer|min:1',
            'disponibilidad_digital' => 'required|integer|min:1',
        ]);

        $libro = new Libros([
            'titulo' => $request->titulo,
            'image' =>'image',// $request->input('image'),
            'categoria_id' => $request->categoria_id,
            'descripcion' => $request->descripcion,
            'fecha_lanzamiento' => $request->fecha_lanzamiento,
            'disponibilidad_fisica' => $request->disponibilidad_fisica,
            'disponibilidad_digital' => $request->disponibilidad_digital,
        ]);

        // Guardar el libro en la base de datos
        $libro->save();

        // Retornar una respuesta de éxito
        return [
            'message' => 'Libro guardado con éxito',
            'libro' => $libro
        ];

    }

    /**
     * Display the specified resource.
     */
    public function show(Libros $libros)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libros $libro)
    {
          // Validar los datos del formulario
          $request->validate([
            'titulo' => 'required|string',
            //'image' => 'required|string',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'descripcion' => 'required|string',
            'fecha_lanzamiento' => 'required|date',
            'disponibilidad_fisica' => 'required|integer|min:1',
            'disponibilidad_digital' => 'required|integer|min:1',
        ]);

        $libro = Libros::find($request->id); //NO ES NECESARIO EN CASO DE QUE FUNCIONE EL SEGUNDO PARAMETRO

        $libro->update([
            'titulo' => $request->titulo,
            'image' =>'image',// $request->input('image'),
            'categoria_id' => $request->categoria_id,
            'descripcion' => $request->descripcion,
            'fecha_lanzamiento' => $request->fecha_lanzamiento,
            'disponibilidad_fisica' => $request->disponibilidad_fisica,
            'disponibilidad_digital' => $request->disponibilidad_digital,
        ]
        );

        $libro->save();

        return [
            'message' => 'Libro editado con éxito',
            'libro' => $libro
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libros $libro)
    {
         // Establecer disponibilidad_fisica y disponibilidad_digital a cero
        $libro->disponibilidad_fisica = 0;
        $libro->disponibilidad_digital = 0;

        // Guardar los cambios en la base de datos
        $libro->save();

        return [
            'message' => 'Usuario Inactivo',
            'user' => $libro
        ];
    }
}
