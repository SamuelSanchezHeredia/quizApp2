@extends('app.base')

@section('title' ,'Index')

@section('content')
<h3> Elige tu rol</h3>
<a href=" {{ url('preguntas')}}">Empezar partida</a><br>
<a href=" {{ url('admin')}}">Administrador de preguntas</a>

@endsection