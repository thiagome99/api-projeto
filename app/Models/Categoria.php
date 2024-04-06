<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
	protected $table = 'projeto_loja.categoria';
	protected $primaryKey = 'codigo_categoria';
	public $timestamps = false;
	protected $fillable = [
		'nome',
        'descricao'
    ];
	
}
