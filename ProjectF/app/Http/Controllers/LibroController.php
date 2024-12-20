<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        return Libro::with('categoria')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:200',
            'isbn' => 'nullable|string|unique:libros,isbn',
            'fecha_publicacion' => 'nullable|date',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
        ]);
        return Libro::create($request->all());
    }

    public function show($id)
    {
        return Libro::with('categoria')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $libro = Libro::findOrFail($id);
        $libro->update($request->all());
        return $libro;
    }

    public function destroy($id)
    {
        Libro::destroy($id);
        return response()->json(null, 204);
    }
}
