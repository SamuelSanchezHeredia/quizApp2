@extends('app.base')

@section('title', 'Edit')

@section('content')
<form action="{{ url('preguntas/' . $preguntas->id) }}" method="post">

    @method('put')
    @csrf

    <!-- Inputs del formulario -->

    <div class="mb-3">

        <label for="pregunta" class="form-label">Pregunta</label>

        <input type="text" class="form-control" id="pregunta" name="pregunta" maxlength="60" required  value="{{ old('pregunta', $preguntas->pregunta) }}">

    </div>

    <div class="mb-3">

        <label for="respuestas" class="form-label">Respuestas</label>

        <input type="text" class="form-control" id="respuestas" name="respuestas" maxlength="110" required value="{{ old('respuestas', $preguntas->respuesta) }}">

    </div>

    <div class="mb-3">

        <label for="year" class="form-label">Respuesta correcta</label><br>

        <select class="form-control">
            <option>Respuesta 1</option>
            <option>Respuesta 2</option>
            <option>Respuesta 3</option>
            <option>Respuesta 4</option>
        </select>

    </div>

    <input type="submit" class="btn btn-dark" value="Edit">
    <a href="{{ url('admin') }}" class="btn btn-dark">Back</a>

</form>
@endsection