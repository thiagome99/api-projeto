<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
	protected $table = 'projeto_loja.produto';
	protected $primaryKey = 'id_produto';
	public $timestamps = false;
	protected $fillable = [
		'nome',
        'descricao',
        'preco',
		'quantidade',
		'novo_usado',
		'id_vendedor'
    ];
	
}
