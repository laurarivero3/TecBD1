<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        // Traer todos los comentarios con sus usuarios relacionados
        return Comentario::with('usuario')->get();
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'contenido' => 'required|string',
            'usuario_id' => 'required|exists:usuarios,id',
            'comentable_id' => 'required|integer',
            'comentable_type' => 'required|string|max:50',
            'fecha_comentario' => 'required|date', // Agregamos la validación para la fecha del comentario
        ]);

        // Crear el comentario con la fecha proporcionada o la fecha actual si no se proporciona
        $comentario = Comentario::create([
            'contenido' => $request->contenido,
            'usuario_id' => $request->usuario_id,
            'comentable_id' => $request->comentable_id,
            'comentable_type' => $request->comentable_type,
            'fecha_comentario' => $request->fecha_comentario ?? now(), // Usar ahora si no se especifica
        ]);

        return response()->json($comentario->load('usuario'), 201); // Devolver el comentario con usuario relacionado
    }

    public function destroy($id)
    {
        Comentario::destroy($id);
        return response()->json(null, 204);
    }
}

