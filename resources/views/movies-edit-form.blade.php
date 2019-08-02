@extends('layout')

@section('title', "Editando $movieToEdit->title")

@section('content')
	<h2>Formulario para editar: {{ $movieToEdit->title }}</h2>

	@if ($errors)
		@foreach ($errors->all() as $oneError)
			<p style="color: red;">{{ $oneError }}</p>
		@endforeach
	@endif

	<form action="/movies/{{ $movieToEdit->id }}" method="post" enctype="multipart/form-data">
		@csrf
		{{ method_field('put') }}

		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label>Título:</label>
					<input class="form-control" type="text" name="title" value="{{ old('title', $movieToEdit->title) }}" placeholder="Ingresá un título wachin">
					@if ($errors->has('title'))
						<p style="color: red;">{{ $errors->first('title') }}</p>
					@endif
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Rating:</label>
					<input class="form-control" type="text" name="rating" value="{{ old('rating', $movieToEdit->rating) }}">
					@error ('rating')
						<p style="color: red;">{{ $errors->first('rating') }}</p>
					@enderror
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Premios:</label>
					<input class="form-control" type="text" name="awards" value="{{ old('awards', $movieToEdit->awards) }}">
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Duración:</label>
					<input class="form-control" type="text" name="length" value="{{ old('length', $movieToEdit->length) }}">
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Fecha de estreno:</label>
					<input class="form-control" type="date" name="release_date" value="{{ $movieToEdit->release_date->format('Y-m-d') }}">
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Imagen:</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="poster">
						<label class="custom-file-label">Choose file</label>
					</div>
					@error ('poster')
						<p style="color: red;">{{ $errors->first('poster') }}</p>
					@enderror
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label>Género:</label>
					<select class="form-control" name="genre_id">
						@foreach ($genres as $oneGenre)
							<option
								value="{{ $oneGenre->id }}"
								{{ $movieToEdit->genre_id == $oneGenre->id ? 'selected' : null }}
							> {{ $oneGenre->name }} </option>
						@endforeach
					</select>
				</div>
			</div>

		</div>

		<button type="submit" class="btn btn-success">Actualizar</button>
	</form>
	@endsection
