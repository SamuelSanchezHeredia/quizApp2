<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AliasController extends Controller
{

    public function guardarNombre(Request $request)
    {
    $nombreUsuario = $request->session()->get('nombre');
    
    

    // Guarda el valor en la sesión
    session(['nombre_usuario' => $nombreUsuario]);
    
    
    
    return redirect()->back();
    
    }
}
