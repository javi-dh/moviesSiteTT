@extends('layout')

@section('title', 'Listado de generos')

@section('content')
	<h2>Listado de generos</h2>
	<ul>
		@foreach ($genres as $oneGenre)
			<li>
				<b>Nombre:</b> {{ $oneGenre->name }}  <br>
				@if (count($oneGenre->movies) > 0)
					@foreach ($oneGenre->movies as $oneMovieByGenre)
						<b>Título: </b> {{ $oneMovieByGenre->title }} <br>
					@endforeach
				@else
					<i>No tiene películas 😆</i>
				@endif
			</li>
		@endforeach
	</ul>
@endsection
