<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;
use App\Genre;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$movies = Movie::all();
			return view('movies-index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
			$genres = Genre::orderBy('name')->get();
			return view('movies-create-form', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			// Validación de Campos
			$request->validate([
				'title' => 'required | string',
				'rating' => 'required | numeric | between:0,10',
				'poster' => 'required | image', // image = .jpg | .jpeg | .png | .svg | .bmp | .gif
			], [
				// 'required' => 'El campo :attribute es obligatorio',
				'title.required' => 'El título es obligatorio',
				'rating.required' => 'El rating es obligatorio',
				'rating.numeric' => 'El rating debe contener solo números',
				'rating.between' => 'El rating debe contener un número entre 0 y 10',
				'poster.required' => 'La imagen es obligatoria',
			]);

			// Request es el famoso $_POST, con un montón de cosas más
			// El método all() pide todos los input que hay en el formulario

			// Forma de guardar #1
			// Movie::create([
			// 	'title' => $request->input('title'),
			// 	'rating' => $request->input('rating'),
			// 	'awards' => $request->input('awards'),
			// 	'length' => $request->input('length'),
			// 	'release_date' => $request->input('release_date'),
			// 	'genre_id' => $request->input('genre_id'),
			// ]);

			// Forma de guardar #2 - create() guarda en DB y retorna el objeto que acabamos de guardar
 			$movieSaved = Movie::create($request->all());

			// Pedimos el campo que tiene la imagen
			$poster = $request->file('poster');

			// Armamos un nombre para la imagen
			$nombreImagen = uniqid('img-') . '.' . $poster->extension();

			// Subir la imagen a la carpeta final
			$poster->storePubliclyAs('public/posters', $nombreImagen);
			// Recordar que la imagen se sube en storage/app/public/posters

			// Después de subir la imagen, vamos a asociarle a la columna poster de la película recién creada, el nombre de la imagen que subimos
			$movieSaved->poster = $nombreImagen;
			$movieSaved->save();

			// Forma de guardar #3 (recomendado para usar en el update)
			// $movieToSave = new Movie;
			// $movieToSave->title = $request->input('title');
			// $movieToSave->rating = $request->input('rating');
			// $movieToSave->awards = $request->input('awards');
			// $movieToSave->length = $request->input('length');
			// $movieToSave->release_date = $request->input('release_date');
			// $movieToSave->genre_id = $request->input('genre_id');
			// $movieToSave->save();

			// Vamos a retornar una redirección a un RUTA
			return redirect('/movies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $movieToShow = Movie::find($id);
			return view('movies-show', compact('movieToShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $movieToEdit = Movie::find($id);
			$genres = Genre::orderBy('name')->get();
			return view('movies-edit-form', compact('movieToEdit', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $movieToUpdate = Movie::find($id);

			$movieToUpdate->title = $request->input('title');
			$movieToUpdate->rating = $request->input('rating');
			$movieToUpdate->awards = $request->input('awards');
			$movieToUpdate->length = $request->input('length');
			$movieToUpdate->release_date = $request->input('release_date');
			$movieToUpdate->genre_id = $request->input('genre_id');

			$poster = $request->file('poster');
			$nombreImagen = uniqid('img-') . '.' . $poster->extension();
			$poster->storePubliclyAs('public/posters', $nombreImagen);

			$movieToUpdate->poster = $nombreImagen;
			$movieToUpdate->save();

			return redirect('/movies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $movieToDelete = Movie::find($id);
			$movieToDelete->delete();
			return redirect('/movies');
    }
}
