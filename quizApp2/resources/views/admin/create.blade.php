@extends('app.base')

@section('title', 'Create')

@section('content')
        <form method="post" action="{{ url('admin') }}">
            @csrf
            <div class="mb-3">
                <label for="pregunta" class="form-label">Pregunta:</label>
                <input type="text" class="form-control" id="pregunta" name="pregunta" required>
            </div>
            <div class="mb-3">
                <label for="respuestas" class="form-label">Respuestas:</label>
                @for ($i = 0; $i < 4; $i++)
                    <input type="text" class="form-control" id="respuestas" name="respuestas[]" required>
                @endfor
            </div>
            <div class="mb-3">
                <label for="correcta" class="form-label">Respuesta Correcta:</label>
                <select class="form-control" id="correcta" name="correcta" required>
                    @for ($i = 0; $i < 4; $i++)
                        <option value="{{ $i }}">{{ $i + 1 }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Pregunta y Respuestas</button>
        </form>
@endsection