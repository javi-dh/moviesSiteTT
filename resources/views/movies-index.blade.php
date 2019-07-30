@extends('layout')

@section('title', 'Listado de películas')

@section('content')
	<h2>Listado de películas</h2>
	<ul>
		@foreach ($movies as $oneMovie)
			<li>
				<b>Título:</b> {{ $oneMovie->title }}  <br>
				<b>Rating:</b> {{ $oneMovie->rating }}  <br>
				<b>Duración:</b> {{ $oneMovie->length }}  <br>
				{{-- Aquí abajo pedimos la relación de genre, no van los () después del nombre de la relación --}}
				@if ($oneMovie->genre)
					<b>Género:</b> {{ $oneMovie->genre->name }}  <br>
				@else
					<b>Género:</b> Sin genero asociado  <br>
				@endif
			</li>
		@endforeach
	</ul>
@endsection
