<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\StaffController;
use App\Models\Order;

class UserController extends Controller
{
    public function index()
    {
        return view('user.userarea');
    }

    public function purchase()
    {
        return view('user.purchase');
    }

    public function create()
    {
        return view('user.new');
    }

    // Admin

    public function admarea()
    {
        return view('adm.admarea');
    }

    public function showpurchases()
    {
        $search = request('pesquisa');

        if (substr($search, 0, 1) == '#') {
            $pedidos = Order::with(['orderitems'])->where('id', substr($search, 1))->paginate(1);
        }elseif(substr($search, 0, 1) == '!'){
            $pedidos = Order::with(['orderitems'])->where('status', substr($search, 1))->paginate(20);
        }elseif(substr($search, 0, 1) == '@'){
            $pedidos = Order::with(['orderitems'])->where('user_id', substr($search, 1))->paginate(20);
        }else{
            $pedidos = Order::with(['orderitems'])->paginate(20);
        }

        $total = [];

        foreach ($pedidos as $p) {
            $total[$p->id] = array();

            for ($ii = 0; $ii < count($p->orderitems); $ii++) {
                if (isset($p->orderitems[$ii]->products))
                    $total[$p->id][$ii] = $p->orderitems[$ii]->products->price * $p->orderitems[$ii]->amount_product;
            }
        }

        return view('adm.purchases', ['pedidos' => $pedidos, 'total' => $total]);
    }

    public function showprodadm()
    {
        $search = request('pesquisa');

        if (substr($search, 0, 1) == '#') {

            $products = Product::where([
                ['id', substr($search, 1)]
            ])->orderByRaw('updated_at DESC, stock DESC, sold DESC')->paginate(20);
        } elseif (substr($search, 0, 1) == '*') {

            $products = Product::where([
                ['stock', 0]
            ])->orderByRaw('updated_at DESC, stock DESC, sold DESC')->paginate(20);
        } elseif (substr($search, 0, 1) == '%') {

            $products = Product::where([
                ['creator_id', substr($search, 1)]
            ])->orderByRaw('updated_at DESC, stock DESC, sold DESC')->paginate(20);
        } elseif (substr($search, 0, 1) == '!') {

            $products = Product::where([
                ['category', substr($search, 1)]
            ])->orderByRaw('id DESC, stock DESC, sold DESC')->paginate(20);
        } elseif ($search) {

            $products = Product::where([
                ['title', 'like', '%' . $search . '%']
            ])->orderByRaw('updated_at DESC, stock DESC, sold DESC')->paginate(20);
        } else {
            $products = Product::orderByRaw('updated_at DESC, stock DESC, sold DESC')->paginate(20);
        }

        return view('adm.products', ['products' => $products]);
    }

    public function createUser(Request $request)
    {
        if ($request->name) {

            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->accessLevel = $request->accessLevel;

            date_default_timezone_set('America/Sao_Paulo');
            $date = date('m/d/Y h:i:s a', time());
            $user->created_at = date('Y-m-d H:i:s', strtotime($date));

            if ($user->save())
                return view('adm.staff.new', ['id' => $user->id])->with('msg', 'Primeira etapa concluída!')->with('stts', 1);
            else
                return view('/usuario/cadastrar')->with('msg', 'Houve um problema ao cadastrar o usuário!')->with('stts', 0);
        } else {
            return redirect('/')->with('msg', 'Houve um problema ao cadastrar o usuário!')->with('stts', 0);
        }
    }

    public function destroyPurchase($id)
    {
        if (Order::findOrFail($id)->delete())
            return redirect('/usuario/adm/pedidos')->with('msg', 'Pedido cancelado com sucesso!')->with('stts', 1);
        else
            return redirect('/usuario/adm/pedidos')->with('msg', 'Houve um problema ao cancelar o pedido!')->with('stts', 0);
    }

    public function updatePurchaseStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->input('status');

        if ($order->save())
            return redirect('/usuario/adm/pedidos')->with('msg', 'Status do pedido atualizado com sucesso!')->with('stts', 1);
        else
            return redirect('/usuario/adm/pedidos')->with('msg', 'Houve um problema ao atualizar o status do pedido!')->with('stts', 0);
    }
}
