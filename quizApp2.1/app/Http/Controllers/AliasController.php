<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AliasController extends Controller
{


   public function guardarNombre(Request $request) {
    $request->validate([
        'nombre' => 'required|string|max:255',
    ]);

    session(['nombre' => $request->input('nombre')]);

    return redirect()->back()->with(['success', 'Alias guardado exitosamente.']);
}
}
