<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;

class EditorialController extends Controller
{
    public function index()
    {
        //return Editorial::all();
        return Editorial::find(1)->libros;
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:editoriales',
            'pais' => 'nullable|string|max:50',
        ]);
        return Editorial::create($request->all());
    }

    public function show($id)
    {
        return Editorial::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $editorial = Editorial::findOrFail($id);
        $editorial->update($request->all());
        return $editorial;
    }

    public function destroy($id)
    {
        Editorial::destroy($id);
        return response()->json(null, 204);
    }
}
