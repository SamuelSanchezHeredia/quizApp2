@extends('app.base')

@section('title' ,'Index')

@section('content')
<form method="post" action="{{ route('admin.preguntas.update', $pregunta->id) }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="pregunta" class="form-label">Pregunta:</label>
            <input type="text" class="form-control" id="pregunta" name="pregunta" value="{{ $pregunta->pregunta }}" required>
        </div>

        <div class="mb-3">
            <label for="respuestas" class="form-label">Respuestas:</label>
            @foreach($respuesta as $key => $respuesta)
                <input type="text" class="form-control" id="respuestas{{ $key }}" name="respuestas[]" value="{{ $respuesta->respuesta }}" required>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="correcta" class="form-label">Respuesta Correcta:</label>
            <select class="form-control" id="correcta" name="correcta" required>
            @foreach($respuesta as $res)
                <option>{{ $res->esCorrecta }}</option>
            @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
        
@endsection