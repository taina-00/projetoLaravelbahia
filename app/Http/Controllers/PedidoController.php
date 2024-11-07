<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\User;
use App\Models\Pedido;
use App\Models\PedidoProduto;
class PedidoController extends Controller
{
    public function formCadastrarPedido() {
        $users = User::all();
        $produtos = Produto::all();
        return view("cadastro_pedido", ["users"=>$users, "produtos"=>$produtos]);
    }

    
    public function cadastrar(Request $request)
    {
      $items = $request->input('items');
      $user = $request->input('user');
      $pedido = new Pedido;
      $pedido->user_id = $user;
      $pedido->save();
      foreach ($items as $itemId => $quantity) {
          if ($quantity > 0) {
              $pedidoProduto = new PedidoProduto;
              $pedidoProduto->pedido_id = $pedido->id;
              $pedidoProduto->produto_id = $itemId;
              $pedidoProduto->quantidade = $quantity;
              $pedidoProduto->save();
          }
      }

      return redirect('/listar_usuarios');
   }

   public function listar() {
    $pedidos = Pedido::all();

    return view('listar_pedidos', ["pedidos" => $pedidos]); 

   }
}
