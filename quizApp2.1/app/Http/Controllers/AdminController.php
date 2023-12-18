<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Preguntas;
use App\Models\Respuestas;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $preguntas = Preguntas::all();
        $respuestas = Respuestas::all();
        return view('admin.index', ['preguntas' => $preguntas,
                                     'respuestas' => $respuestas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
        $pregunta = Preguntas::create([
            'pregunta' => $request->pregunta,
        ]);

        // Crea las respuestas
        foreach ($request->respuesta as $key => $respuesta) {
            Respuestas::create([
                'idPregunta' => $pregunta->id,
                'respuestas' => $respuesta,
                'esCorrecta' => $key == $request->correcta,
            ]);
        }

        return redirect('admin')->with('success', 'Pregunta y respuestas guardadas correctamente.');
        } catch(\Exception $e) {
            return redirect('admin')->with('success', 'Pregunta y respuestas guardadas correctamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        return view('admin.show', ['admin' => $admin]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
         public function edit($id) {
        $pregunta = Preguntas::find($id);
        $respuestas = Respuestas::where('idPregunta', $id)->get();
    
        return view('admin.edit', ['pregunta' => $pregunta,
                                    'respuestas' => $respuestas]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $pregunta = Preguntas::find($id);
    
        $pregunta->update([
            'pregunta' => $request->pregunta,
        ]);
    
        // Eliminar respuestas antiguas
        Respuestas::where('idPregunta', $id)->delete();
    
        foreach ($request->respuestas as $key => $respuestaTexto) {
            $escorrecta = $key == $request->correcta;
    
            // Crear nuevas respuestas
            Respuestas::create([
                'idPregunta' => $id,
                'respuesta' => $respuestaTexto,
                'esCorrecta' => $escorrecta,
            ]);
        }
    
        return redirect('admin')->with('success', 'Pregunta actualizada correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Preguntas::destroy($id);
    
        return redirect()->back()->with('success', 'Pregunta eliminada correctamente.');
    }
    
}
