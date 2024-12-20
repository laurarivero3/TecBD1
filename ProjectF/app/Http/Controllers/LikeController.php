<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        return Like::with('usuario')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'likeable_id' => 'required|integer',
            'likeable_type' => 'required|string|max:50',
        ]);
        return Like::create($request->all());
    }

    public function destroy($id)
    {
        Like::destroy($id);
        return response()->json(null, 204);
    }
}
