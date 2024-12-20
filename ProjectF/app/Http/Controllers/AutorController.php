<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        return Autor::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'nacionalidad' => 'nullable|string|max:50',
        ]);
        return Autor::create($request->all());
    }

    public function show($id)
    {
        return Autor::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $autor = Autor::findOrFail($id);
        $autor->update($request->all());
        return $autor;
    }

    public function destroy($id)
    {
        Autor::destroy($id);
        return response()->json(null, 204);
    }
}
