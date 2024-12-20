<?php

namespace App\Http\Controllers;

use App\Models\DetallePrestamo;
use Illuminate\Http\Request;

class DetallePrestamoController extends Controller
{
    public function index()
    {
        return DetallePrestamo::with(['prestamo', 'libro'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'prestamo_id' => 'required|exists:prestamos,id',
            'libro_id' => 'required|exists:libros,id',
            'cantidad' => 'required|integer',
        ]);
        return DetallePrestamo::create($request->all());
    }

    public function destroy($id)
    {
        DetallePrestamo::destroy($id);
        return response()->json(null, 204);
    }
}
