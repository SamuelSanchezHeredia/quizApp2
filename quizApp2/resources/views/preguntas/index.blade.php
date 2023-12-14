@extends('app.base')

@section('title' ,'Index')

@section('content')
<form action="{{ url('preguntas') }}" method="post">
        @csrf
        
        
                                    @foreach($preguntas as $pregunta)
                                        <div class="card @if(!$loop->last)mb-3 @endif">
                                            <div class="card-header">{{ $pregunta->pregunta }}</div>
                                            
                                            <div class="card-body">
                                                <input type="hidden" name="pregunta[{{ $pregunta->id }}]" value="">
                                                
                                                @foreach($respuestas->where('idPregunta', $pregunta->id) as $respuesta)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pregunta[{{ $pregunta->id }}]" id="respuesta-{{ $respuesta->id }}" value="{{ $respuesta->id }}" @if(old("preguntas.$pregunta->id") == $respuesta->id) checked @endif>
                                                        <label class="form-check-label" for="respuesta-{{ $respuesta->id }}">
                                                            {{ $respuesta->respuesta }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
        
        <button type="submit" class="btn btn-primary">Entregar quiz</button>

    </form>
@endsection