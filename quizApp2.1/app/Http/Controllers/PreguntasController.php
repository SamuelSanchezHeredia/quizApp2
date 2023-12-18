<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Preguntas;
use App\Models\Respuestas;

class PreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preguntas = Preguntas::all()->shuffle()->take(10);
        $respuestas = Respuestas::all();
        return view('preguntas.index' , ['preguntas' => $preguntas,'respuestas' => $respuestas ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('preguntas.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $respuestasEnviadas = $request->input('pregunta');

        $aciertos = 0;
        $fallos = 0;
    
        foreach ($respuestasEnviadas as $idPregunta => $idRespuestaEnviada) {
            $respuestaCorrecta = Respuestas::where('idPregunta', $idPregunta)
                ->where('esCorrecta', true)
                ->first();
    
            if ($idRespuestaEnviada == $respuestaCorrecta->id) {
                $aciertos++;
            } else {
                $fallos++;
            }
        }
    
        return view('preguntas.resultados', compact('aciertos', 'fallos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function show(Preguntas $preguntas)
    {
        return view('preguntas.show', ['preguntas' => $preguntas]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function edit(Preguntas $preguntas)
    {
        return view('preguntas.edit', ['preguntas' => $preguntas]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preguntas $preguntas)
    {
        try {
            $result = $preguntas->update($request->all());
            
            $afterEdit = session('afetrEdit', 'preguntas');
            if($afterEdit == 'preguntas') {
                $target = 'preguntas';
            } else if($afterEdit == 'edit') {
                $target = 'preguntas/' . $preguntas->id . '/edit';
            } else {
                $target = 'preguntas/' . $preguntas->id;
            }
            
            return redirect($target)->with(['message' => 'La pregunta ha sido actualizada.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'La pregunta no ha sido actualizada']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preguntas $preguntas)
    {
        try {
            $preguntas->delete();
            return redirect('respuestas')->with(['message' => 'La pregunta ha sido borrada.']);
        } catch(\Exception $e) {
             return back()->withErrors(['message' => 'La pregunta no ha sido borrada.']);
        }
    }
    
    public function view(Request $request, Preguntas $id) {
        $preguntas = Preguntas::find($id);
        if($preguntas == null) {
            return abort(404);
        }
        dd([$id, $preguntas]);
    }
    
    public function comprobar(Request $request) {
        $preguntas = Preguntas::find(esCorrecta == 1);
        $respuestasUsuario = $request->input('opcion');
        
        
        
    }
        
}
