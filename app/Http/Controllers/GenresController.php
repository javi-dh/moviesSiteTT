<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Genre;

class GenresController extends Controller
{
	public function mostrarTodos()
	{
		$genres = Genre::all();
		return view('genres-index', compact('genres'));
	}
}
