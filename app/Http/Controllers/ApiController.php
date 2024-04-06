<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Produto_Possui_Categoria;

class ApiController
{

/*--------------- Produto ---------------*/

    public function create_produto(Request $request) {

		try{
			$produto = new Produto;
			$produto->nome = $request->nome;
			$produto->descricao = $request->descricao;
			$produto->preco = $request->preco;
			$produto->quantidade = $request->quantidade;
			$produto->novo_usado = $request->novo_usado;
			$produto->id_vendedor = $request->id_vendedor;
			$produto->save();

			return response()->json(["message" => "Produto adicionado com sucesso!"], 200);
		}catch (\Exception $e) {
			return response()->json(["message" => "Falha ao adicionar o produto!", 
									"exception" => $e->getMessage()], 405);
		}	
    }

	public function read_produto_all() {
		$produtos = Produto::all();
		return response()->json($produtos, 200);
    }

	public function read_produto_id($id_produto) {
		$produto = Produto::find($id_produto);
		
		if($produto) {
			return response()->json($produto, 200);
		}else {
			return response()->json(["message" => "Produto não encontrado!"], 404);
		}
    }

	public function update_produto(Request $request, $id_produto) {
		$produto = Produto::find($id_produto);

		if ($produto) {

			try {
				if($request->nome) {$produto->nome = $request->nome;}
				if($request->descricao) {$produto->descricao = $request->descricao;}
				if($request->preco) {$produto->preco = $request->preco;}
				if($request->quantidade) {$produto->quantidade = $request->quantidade;}
				if($request->novo_usado) {$produto->novo_usado = $request->novo_usado;}
				if($request->id_vendedor) {$produto->id_vendedor = $request->id_vendedor;}
				$produto->save();

				return response()->json(["message" => "Produto atualizado com sucesso!"], 200);
			} catch (\Exception $e) {
				return response()->json(["message" => "Falha ao atualizar o produto!", 
										"exception" => $e->getMessage()], 405);
			}

		} else {
			return response()->json(["message" => "Produto não encontrado!"], 404);
		}
	}


	public function delete_produto($id_produto) {
		$produto = Produto::find($id_produto);

		if ($produto) {
			$produto->delete();
			return response()->json(["message" => "Produto deletado com sucesso!"], 200);
		} else {
			return response()->json(["message" => "Produto não encontrado"], 404);
		}
	}

/*--------------- Categoria ---------------*/

    public function create_categoria(Request $request) {

		try{
			$categoria = new Categoria;
			$categoria->nome = $request->nome;
			$categoria->descricao = $request->descricao;
			$categoria->save();

			return response()->json(["message" => "Categoria adicionada com sucesso!"], 200);
		}catch (\Exception $e) {
			return response()->json(["message" => "Falha ao adicionar a categoria!", 
									"exception" => $e->getMessage()], 405);
		}	
    }

	public function read_categoria_all() {
		$categorias = Categoria::all();
		return response()->json($categorias, 200);
    }

	public function read_categoria_codigo($codigo_categoria) {
		$categoria = Categoria::find($codigo_categoria);
		
		if($categoria) {
			return response()->json($categoria, 200);
		}else {
			return response()->json(["message" => "Categoria não encontrada!"], 404);
		}
    }

	public function update_categoria(Request $request, $codigo_categoria) {
		$categoria = Categoria::find($codigo_categoria);

		if ($categoria) {

			try {
				if($request->nome) {$categoria->nome = $request->nome;}
				if($request->descricao) {$categoria->descricao = $request->descricao;}
				$categoria->save();

				return response()->json(["message" => "Categoria atualizada com sucesso!"], 200);
			} catch (\Exception $e) {
				return response()->json(["message" => "Falha ao atualizar a categoria!", 
										"exception" => $e->getMessage()], 405);
			}

		} else {
			return response()->json(["message" => "Categoria não encontrada!"], 404);
		}
	}


	public function delete_categoria($codigo_categoria) {
		$categoria = Categoria::find($codigo_categoria);

		if ($categoria) {
			$categoria->delete();
			return response()->json(["message" => "Categoria deletada com sucesso!"], 200);
		} else {
			return response()->json(["message" => "Categoria não encontrada"], 404);
		}
	}


	/*--------------- Produto-Categoria ---------------*/

    public function create_produtocategoria(Request $request) {

		try{
			$prodcat = new Produto_Possui_Categoria;
			$prodcat->id_produto = $request->id_produto;
			$prodcat->codigo_categoria = $request->codigo_categoria;
			$prodcat->save();

			return response()->json(["message" => "O produto foi adicionado a categoria com sucesso!"], 200);
		}catch (\Exception $e) {
			return response()->json(["message" => "Falha ao adicionar o produto a categoria!", 
									"exception" => $e->getMessage()], 405);
		}	
    }

	public function read_produtocategoria_all() {
		$prodcat = Produto_Possui_Categoria::all();
		return response()->json($prodcat, 200);
    }

	public function read_produtocategoria_id($id_produto, $codigo_categoria) {
		$prodcat = Produto_Possui_Categoria::where('id_produto', $id_produto)->where('codigo_categoria', $codigo_categoria)->first();
		
		if($prodcat) {
			return response()->json($prodcat, 200);
		}else {
			return response()->json(["message" => "Não existe relacionamento entre esse produto e categoria, ou eles podem não existir!"], 404);
		}
    }

	public function update_produtocategoria(Request $request, $id_produto, $codigo_categoria) {

		$prodcat = Produto_Possui_Categoria::where(['id_produto' => $id_produto, 'codigo_categoria' => $codigo_categoria])->first();
		
		if ($prodcat) {

			try {
				if($request->id_produto) {$prodcat->id_produto = $request->id_produto;}
				if($request->codigo_categoria) {$prodcat->codigo_categoria = $request->codigo_categoria;}
				
				$prodcat->save();

				return response()->json(["message" => "Relacionamento entre produto e categoria atualizado com sucesso!"], 200);
			} catch (\Exception $e) {
				return response()->json(["message" => "Falha ao atualizar o relacionamento!", 
										"exception" => $e->getMessage()], 405);
			}

		} else {
			return response()->json(["message" => "O relacionamento entre produto e categoria não foi encontrado!"], 404);
		}
	}


	public function delete_produtocategoria($id_produto, $codigo_categoria) {
		$prodcat = Produto_Possui_Categoria::where('id_produto', $id_produto)->where('codigo_categoria', $codigo_categoria)->first();
		
		if ($prodcat) {
			$prodcat->delete();
			return response()->json(["message" => "Relacionamento ente deletada com sucesso!"], 200);
		} else {
			return response()->json(["message" => "Categoria não encontrada"], 404);
		}
	}

}
