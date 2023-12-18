@extends('app.base')

@section('title' ,'Index')

@section('content')
    <form method="post" action="{{ route('admin.preguntas.update', $pregunta->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="pregunta" class="form-label">Pregunta:</label>
            <input type="text" class="form-control" id="pregunta" name="pregunta" value="{{ $pregunta->pregunta }}" required>
        </div>

        <div class="mb-3">
            <label for="respuestas" class="form-label">Respuestas:</label>
            @foreach($respuestas as $key => $respuesta)
                <input type="text" class="form-control" id="respuestas{{ $key }}" name="respuestas[]" value="{{ $respuesta->respuesta }}" required>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="correcta" class="form-label">Respuesta Correcta:</label>
            <select class="form-control" id="correcta" name="correcta" required>
                @foreach($respuestas as $key => $respuesta)
                    <option value="{{ $key }}" @if($respuesta->escorrecta) selected @endif>{{ $key + 1 }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
        
@endsection