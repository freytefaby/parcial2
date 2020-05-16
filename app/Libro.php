<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table='libros';
	public $timestamps=false;
	
	protected $fillable=[
	'nombre',
	'paginas',
	'categorias_fk',
    'users_fk',
    'isbn'
	
	
	];
	protected $guarded=[
	
	];
}
