<?php

namespace App\Http\Controllers;

use App\Models\Historial;


use Illuminate\Http\Request;

class historialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historial = Historial::all();
        return view('historial.index' , ['historial' => $historial]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('historial.create');

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
        $object = new Historial($request->all());
        
        // 2º Intentar guardar
        try {
            $result = $object->save();
            // $object = Movie::create($request->all());
            // 3º Si lo he guardado, volver a 'algún sitio: index, create'
            $afterInsert = session('afterInsert', 'show historial');
            $target = 'historial';
            if($afterInsert != 'show historial') {
                $target = 'historial/create';
            }
            return redirect($target)->with(['message' => 'El historial ha sido guardado.']);
            
        } catch(\Exception $e) {
            // 4º Si no lo he guardado, volver a la página anterior con sus datos para volver a rellenar el formulario
            return back()->withInput()->withErrors(['message' => 'El historial no ha sido guardado.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function show(historial $historial)
    {
        return view('historial.show', ['historial' => $historial]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function edit(historial $historial)
    {
        return view('historial.edit', ['historial' => $historial]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, historial $historial)
    {
        try {
            $result = $historial->update($request->all());
            
            $afterEdit = session('afetrEdit', 'historial');
            if($afterEdit == 'historial') {
                $target = 'historial';
            } else if($afterEdit == 'edit') {
                $target = 'historial/' . $historial->id . '/edit';
            } else {
                $target = 'historial/' . $historial->id;
            }
            
            return redirect($target)->with(['message' => 'El historial ha sido actualizado.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El historial no ha sido actualizado.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\argoApp  $argoApp
     * @return \Illuminate\Http\Response
     */
    public function destroy(historial $historial)
    {
        try {
            $historial->delete();
            return redirect('respuestas')->with(['message' => 'El historial ha sido borrado.']);
        } catch(\Exception $e) {
             return back()->withErrors(['message' => 'El historial no ha sido borrado.']);
        }
    }
    
    public function view(Request $request, historial $id) {
        $historial = Historial::find($id);
        if($historial == null) {
            return abort(404);
        }
        dd([$id, $historial]);
    }
}
