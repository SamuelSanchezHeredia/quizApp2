@extends('app.base')

@section('title', 'Resultado')

@section('content')


<h1>Resultados</h1>
<p>Aciertos: {{ $aciertos }}</p>
<p>Fallos: {{ $fallos }}</p>

<div style="display: inline;">
<a class="btn btn-danger" href='{{ url('preguntas') }}'>Volver a jugar</a>
<a class="btn btn-dark" href='{{ url('') }}'>Volver al inicio</a>
</div>

@endsection