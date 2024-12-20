<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    public function index()
    {
        return Archivo::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_archivo' => 'required|string|max:255',
            'ruta_archivo' => 'required|string|max:255',
            'archivoable_id' => 'required|integer',
            'archivoable_type' => 'required|string|max:50',
        ]);
        return Archivo::create($request->all());
    }

    public function show($id)
    {
        return Archivo::findOrFail($id);
    }

    public function destroy($id)
    {
        Archivo::destroy($id);
        return response()->json(null, 204);
    }
}
