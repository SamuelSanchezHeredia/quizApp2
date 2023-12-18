<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Respuestas;


class RespuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index()
    {
        $respuestas = Respuestas::all();
        return view('respuestas.index' , ['respuestas' => $respuestas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function create()
    {
        return view('respuestas.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1º Generar objeto para guardar
        $object = new Respuestas($request->all());
        
        // 2º Intentar guardar
        try {
            $result = $object->save();
            // $object = Movie::create($request->all());
            // 3º Si lo he guardado, volver a 'algún sitio: index, create'
            $afterInsert = session('afterInsert', 'show respuestas');
            $target = 'respuestas';
            if($afterInsert != 'show respuestas') {
                $target = 'respuestas/create';
            }
            return redirect($target)->with(['message' => 'La respuesta ha sido guardada.']);
            
        } catch(\Exception $e) {
            // 4º Si no lo he guardado, volver a la página anterior con sus datos para volver a rellenar el formulario
            return back()->withInput()->withErrors(['message' => 'La respuesta no ha sido guardada.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function show(Respuestas $respuestas)
    {
        return view('respuestas.show', ['respuestas' => $respuestas]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function edit(Respuestas $respuestas)
    {
        return view('respuestas.edit', ['respuestas' => $respuestas]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Respuestas $respuestas)
    {
        try {
            $result = $respuestas->update($request->all());
            
            $afterEdit = session('afetrEdit', 'respuestas');
            if($afterEdit == 'respuestas') {
                $target = 'respuestas';
            } else if($afterEdit == 'edit') {
                $target = 'respuestas/' . $respuestas->id . '/edit';
            } else {
                $target = 'respuestas/' . $respuestas->id;
            }
            
            return redirect($target)->with(['message' => 'La respuesta ha sido actualizada.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'La respuesta no ha sido actualizada']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Respuestas $respuestas)
    {
        try {
            $respuestas->delete();
            return redirect('respuestas')->with(['message' => 'La respuesta ha sido borrada.']);
        } catch(\Exception $e) {
             return back()->withErrors(['message' => 'La respuesta no ha sido borrada.']);
        }
    }
    

    public function view(Request $request, Respuestas $id) {
        $respuestas = Respuestas::find($id);
        if($preguntas == null) {
            return abort(404);
        }
        dd([$id, $respuestas]);
    }
}
