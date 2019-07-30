@extends('layout')

@section('title', 'Crea una película')

@section('content')
	<h2>Formulario para crear películas</h2>

	@if ($errors)
		@foreach ($errors->all() as $oneError)
			<p style="color: red;">{{ $oneError }}</p>
		@endforeach
	@endif

	<form action="/movies/store" method="post">
		{{-- Token de Seguridad --}}
		{{-- Genera un input de tipo hidden con el token en el value --}}
		{{-- También se puede así: --}}
		{{-- {{ csrf_field() }} --}}
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label>Título:</label>
					<input class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="Ingresá un título wachin">
					@if ($errors->has('title'))
						<p style="color: red;">{{ $errors->first('title') }}</p>
					@endif
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Rating:</label>
					<input class="form-control" type="text" name="rating" value="{{ old('rating') }}">
					@error ('rating')
						<p style="color: red;">{{ $errors->first('rating') }}</p>
					@enderror
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Premios:</label>
					<input class="form-control" type="text" name="awards">
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Duración:</label>
					<input class="form-control" type="text" name="length">
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Fecha de estreno:</label>
					<input class="form-control" type="date" name="release_date">
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Género:</label>
					<select class="form-control" name="genre_id">
						@foreach ($genres as $oneGenre)
							<option value="{{ $oneGenre->id }}"> {{ $oneGenre->name }} </option>
						@endforeach
					</select>
				</div>
			</div>

		</div>

		<button type="submit" class="btn btn-success">Guardar</button>
	</form>
	@endsection
