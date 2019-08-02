@extends('layout')

@section('title', $movieToShow->title)

@section('content')
	<h2>Detalle de: {{ $movieToShow->title }}</h2>
	<p><b>Rating:</b> {{ $movieToShow->rating }}</p>
	<p><b>Genero:</b> {{ $movieToShow->genre ? $movieToShow->genre->name : 'Sin género asociado' }}</p>
	<img src="/storage/posters/{{ $movieToShow->poster }}" width="200">
	<hr>
	<form action="/movies/{{ $movieToShow->id }}" method="post" style="display: inline-block;">
		{{-- Siempre un formulario necesita el toke --}}
		@csrf
		{{-- Para usar el método HTTP que realmente queremos usar --}}
		{{ method_field('delete') }}
		<button type="submit" class="btn btn-danger">BORRAR</button>
	</form>
	<a href="/movies/edit/{{ $movieToShow->id }}" class="btn btn-warning">Editar</a>
@endsection
