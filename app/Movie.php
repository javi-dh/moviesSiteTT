<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
	// Acá van las columnas que queremos escribir
	protected $fillable = ['title', 'rating', 'awards', 'length', 'release_date', 'genre_id'];

	// Aca van las columnas que quiero proteger
	protected $guarded = [];

	// Relación con Géneros - Una película pertenece a un género
	public function genre()
	{
		return $this->belongsTo(Genre::class);
	}
}
