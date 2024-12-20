<?php

namespace App\Http\Controllers;

use App\Models\Sancion;
use Illuminate\Http\Request;

class SancionController extends Controller
{
    public function index()
    {
        return Sancion::all();
    }
    
    public function store(Request $request)
{
    // Validación de los datos recibidos
    $request->validate([
        'usuario_id' => 'required|exists:usuarios,id', // Verifica que el usuario existe
        'monto' => 'required|numeric', // El monto debe ser numérico
        'motivo' => 'required|string|max:255', // El motivo de la sanción
        'fecha_sancion' => 'required|date',  // La fecha de la sanción debe ser una fecha válida
    ]);

    // Crear la sanción con los datos recibidos
    $sancion = Sancion::create([
        'usuario_id' => $request->usuario_id,
        'motivo' => $request->motivo,
        'monto' => $request->monto,
        'fecha_sancion' => $request->fecha_sancion,
    ]);

    // Devolver la sanción creada, incluyendo los detalles del usuario
    return response()->json($sancion->load('usuario'), 201);  // Se incluye el usuario en la respuesta
}


    public function show($id)
    {
        return Sancion::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $sancion = Sancion::findOrFail($id);
        $sancion->update($request->all());
        return $sancion;
    }

    public function destroy($id)
    {
        Sancion::destroy($id);
        return response()->json(null, 204);
    }
}
