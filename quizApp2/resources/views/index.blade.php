@extends('app.base')

@section('title' ,'Index')

@section('content')
<h3> Elige tu rol</h3>
<a href=" {{ url('preguntas')}}">Juego</a><br>
<a href=" {{ url('admin')}}">Admin</a>

@endsection