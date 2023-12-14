@extends('app.base')

@section('title' ,'Show preguntas')

@section('content')
    <div class="table-responsive small">
            <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Preguntas</th>
          <th scope="col">Respuestas</th>
          <th scope="col">Respuesta correcta</th>
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
            </tr>
        @endforeach
      </tbody>
    </table>
    </div>
@endsection