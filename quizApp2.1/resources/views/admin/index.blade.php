@extends('app.base')

@section('title', 'Index')

@section('content')

<div class="table-responsive small">
    <a class="btn-info btn" href="{{ url('admin/create') }}">Crear nueva</a><br><br>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Preguntas</th>
          <th scope="col">Respuestas</th>
          <th scope="col">Respuesta correcta</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($preguntas as $pregunta)
            <tr>
                <td>{{ $pregunta->id }}</td>
                <td>{{ $pregunta->pregunta }}</td>
<td>
        @foreach($respuestas as $respuesta)
            @if($pregunta->id == $respuesta->idPregunta)
                {{ $respuesta->respuesta }}<br>
                @endif
                
                @endforeach
                </td>
                <td>
        @foreach($respuestas as $respuesta)
            @if($pregunta->id == $respuesta->idPregunta)
                 @if($respuesta->esCorrecta == 1)
                {{ $respuesta->respuesta }}<br>
                @endif
                 @endif
                @endforeach
                </td>
                <td>
                    <a class="btn-info btn" href="{{ url('admin/' . $pregunta->id . '/edit') }}">Edit</a>
                    <form data-pregunta="{{ $pregunta->pregunta }}" class="formDelete" action="{{ route('admin.preguntas.destroy', $pregunta->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>

@endsection