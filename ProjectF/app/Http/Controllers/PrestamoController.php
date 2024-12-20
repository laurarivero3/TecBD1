<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    // Obtener todos los préstamos con sus relaciones
    public function index()
    {
        return Prestamo::find(1)->detalles;

        return Prestamo::with(['usuario', 'estado'])->get();
    }

    // Crear un nuevo préstamo
    public function store(Request $request)
{
    $request->validate([
        'usuario_id' => 'required|exists:usuarios,id',
        'fecha_devolucion' => 'required|date|after:now',
        'estado_id' => 'required|exists:estadosprestamo,id',
    ]);

    $prestamo = Prestamo::create([
        'usuario_id' => $request->usuario_id,
        'fecha_prestamo' => now(),
        'fecha_devolucion' => $request->fecha_devolucion,
        'estado_id' => $request->estado_id,
    ]);

    return response()->json($prestamo->load(['usuario', 'estado']), 201);
}


    // Mostrar un préstamo por ID
    public function show($id)
    {
        return Prestamo::with(['usuario', 'estado'])->findOrFail($id);
    }

    // Actualizar un préstamo
    public function update(Request $request, $id)
    {
        $request->validate([
            'usuario_id' => 'nullable|exists:usuarios,id',
            'estado_id' => 'nullable|exists:estado_prestamos,id',
            'fecha_devolucion' => 'nullable|date|after:fecha_prestamo',
        ]);

        $prestamo = Prestamo::findOrFail($id);
        $prestamo->update($request->only(['usuario_id', 'fecha_devolucion', 'estado_id']));

        return response()->json($prestamo->load(['usuario', 'estado']));
    }

    // Eliminar un préstamo
    public function destroy($id)
    {
        Prestamo::destroy($id);
        return response()->json(null, 204);
    }
}
