<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Deliveryaddress;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Personaldata;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $amount = Cart::where('id_user', auth()->id())->count();
        session(['cartAmount' => $amount]);

        $carrinho = Cart::where('id_user', auth()->id())->orderBy('created_at')->get()->toArray();

        $id_produtos = array();

        for ($ii = 0; $ii < count($carrinho); $ii++) {
            array_push($id_produtos, $carrinho[$ii]['id_product']);
        }

        $produto = Product::select('*')->join('carts', 'carts.id_product', '=', 'products.id')->where('carts.id_user', auth()->id())->get()->toArray();

        $total = 0;

        foreach ($produto as $p) {
            $total += $p['price'] * $p['amount_product'];
        }

        return view('cart.index', ['produtos' => $produto, 'total' => $total]);
    }

    public function insertCart(Request $request)
    {
        $varCart = Cart::where([
            ['id_user', '=', auth()->id()],
            ['id_product', '=', $request->id_product],
        ])->get()->toArray();

        if ($varCart) {
            return redirect('/carrinho')->with('msg', 'Este produto já está em seu carrinho')->with('stts', 0);;
        } else {

            $cart = new Cart();

            $cart->id_user = auth()->id();
            $cart->id_product = $request->id_product;
            $cart->amount_product = $request->amount;

            date_default_timezone_set('America/Sao_Paulo');
            $date = date('m/d/Y h:i:s a', time());
            $cart->created_at = date('Y-m-d H:i:s', strtotime($date));

            if ($cart->save())
                return redirect('/carrinho')->with('msg', 'Produto adicionado ao carrinho com sucesso!')->with('stts', 1);
            else
                return redirect('/carrinho')->with('msg', 'Houve um problema ao adicionar o produto ao carrinho')->with('stts', 0);
        }
    }

    public function updateInc(Request $request)
    {
        $quantItem = Cart::where('id', $request->id)->select('amount_product')->get();
        $quant = $quantItem[0]->amount_product;

        $cartItem = Cart::where('id', $request->id)->select('id_product')->get();
        $prodId = $cartItem[0]->id_product;

        $stockItem = Product::where('id', $prodId)->select('stock')->get(); //
        $stock = $stockItem[0]->stock;

        if ($quant < $stock) {
            Cart::where('id', $request->id)->increment('amount_product', 1);
            return redirect('/carrinho')->with('msg', 'Adicionado mais uma unidade com sucesso!')->with('stts', 1);
        } else {
            return redirect('/carrinho')->with('msg', 'Estoque máximo atingido!')->with('stts', 0);
        }
    }

    public function updateDec(Request $request)
    {
        $quant = Cart::where('id', $request->id)->select('amount_product')->get();

        if ($quant[0]->amount_product > 1) {
            Cart::where('id', $request->id)->decrement('amount_product', 1);
            return redirect('/carrinho')->with('msg', 'Deletada uma unidade com sucesso!')->with('stts', 1);
        } else {
            Cart::where('id', $request->id)->first()->delete();
            return redirect('/carrinho')->with('msg', 'Produto deletado do carrinho com sucesso!')->with('stts', 1);
        }
    }

    public function delete(Request $request)
    {
        if (Cart::findOrFail($request->id)->delete())
            return redirect('/carrinho')->with('msg', 'Deletada uma unidade com sucesso!')->with('stts', 1);
        else
            return redirect('/carrinho')->with('msg', 'Houve um problema ao deletar uma unidade')->with('stts', 0);
    }

    public function finalize()
    {
        $dadospessoais = Personaldata::where([
            ['user_id', auth()->id()]
        ])->get();

        $dadosentrega = Deliveryaddress::where([
            ['id', auth()->id()]
        ])->get();

        $hasPersonalData = false;
        $hasDeliveryAdrress = false;

        if ($dadospessoais->count() == 1)
            $hasPersonalData = true;

        if ($dadosentrega->count() == 1)
            $hasDeliveryAdrress = true;

        $produto = Product::select('*')->join('carts', 'carts.id_product', '=', 'products.id')->where('carts.id_user', auth()->id())->get()->toArray();

        $total = 0;

        foreach ($produto as $p) {
            $total += $p['price'] * $p['amount_product'];
        }

        return view('cart.finalize', ['total' => $total, 'hasPersonalData' => $hasPersonalData, 'hasDeliveryAdrress' => $hasDeliveryAdrress]);
    }

    public function buy()
    {
        $order = new Order();

        $order->user_id = auth()->id();

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('m/d/Y h:i:s a', time());
        $order->created_at = date('Y-m-d H:i:s', strtotime($date));

        $order->save();

        //-----------------------------------------

        $carrinho = Cart::where('id_user', auth()->id())->get()->toArray();

        $id = $order->id; // ID pedido

        $comprou = false;

        foreach ($carrinho as $key => $item) {
            Product::where('id', $item['id_product'])->decrement('stock', $item['amount_product']);
            Product::where('id', $item['id_product'])->increment('sold', $item['amount_product']);

            $orderItems = new Orderitem();

            $orderItems->order_id = $id;
            $orderItems->product_id = $item['id_product'];
            $orderItems->amount_product = $item['amount_product'];

            date_default_timezone_set('America/Sao_Paulo');
            $date = date('m/d/Y h:i:s a', time());
            $orderItems->created_at = date('Y-m-d H:i:s', strtotime($date));

            if ($orderItems->save())
                $comprou = true;
        }

        if ($comprou) {
            Cart::where('id_user', auth()->id())->delete();
            return redirect('/cliente/pedidos')->with('msg', 'Compra realizada com sucesso!')->with('stts', 1);;
        } else {
            return redirect('/carrinho/finalizar')->with('msg', 'Houve um erro ao realizar a compra!')->with('stts', 0);;
        }
    }
}
