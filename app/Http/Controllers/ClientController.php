<?php

namespace App\Http\Controllers;

use App\Models\Deliveryaddress;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Personaldata;
use App\Models\Relation;

class ClientController extends Controller
{
    public function index()
    {
        $search = request('pesquisa');
        
        if (substr($search, 0, 1) == '#') {

            $users = User::with(['orders'])->where([
                ['accessLevel', 0],
                ['id', substr($search, 1)]
            ])->orderByRaw('updated_at DESC')->get();

        } elseif (substr($search, 0, 1) == '@') {

            $users = User::with(['orders'])->where([
                ['accessLevel', 0],
                ['email', 'like', '%' . substr($search, 1) . '%']
            ])->orderByRaw('updated_at DESC')->paginate(20);
            
        }elseif($search) {

            $users = User::with(['orders'])->where([
                ['accessLevel', 0],
                ['name', 'like', '%' . $search . '%']
            ])->orderByRaw('updated_at DESC')->paginate(20);

        }else{
            $users = User::with(['orders'])->where('accessLevel', 0)->orderByRaw('updated_at DESC')->paginate(20);
        }

        return view('adm.client.clients', ['users' => $users]);
    }

    public function dadospessoais()
    {
        $cliente = Personaldata::where([
            ['user_id', auth()->id()]
        ])->get();

        if ($cliente->count() == 1) {
            return view('user.dados.pessoais', ['dadosCliente' => $cliente]);
        } else {
            return view('user.dados.pessoais', ['dadosCliente' => null]);
        }
    }

    public function dadosentrega()
    {
        $cliente = Deliveryaddress::where([
            ['id', auth()->id()]
        ])->get();

        if ($cliente->count() == 1) {
            return view('user.dados.entrega', ['dadosCliente' => $cliente]);
        } else {
            return view('user.dados.entrega', ['dadosCliente' => null]);
        }
    }

    public function newPersonalData()
    {
        return view('user.dados.entrega');
    }

    public function savePersonalData(Request $request)
    {
        $clientData = new Personaldata();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/clients'), $imageName);
            $clientData->picture = $imageName;
        }

        $clientData->user_id = auth()->id();
        $clientData->name = $request->name;
        $clientData->lastname = $request->lastname;
        $clientData->cpf = $request->cpf;
        $clientData->birthdate = $request->birthdate;
        $clientData->cep = $request->cep;
        $clientData->street = $request->street;
        $clientData->number = $request->number;
        $clientData->reference = $request->reference;
        $clientData->contact1 = $request->contact1;
        $clientData->contact2 = $request->contact2;

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('m/d/Y h:i:s a', time());
        $clientData->created_at = date('Y-m-d H:i:s', strtotime($date));

        if ($clientData->save()) {
            return redirect('/usuario')->with('msg', 'Dados salvos com com sucesso!');
        } else {
            return redirect('/usuario')->with('msg', 'Houve um problema ao salvar seus dados!');
        }
    }

    public function attPersonalData(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        if (Personaldata::where('user_id', auth()->id())->update($data))
            return redirect('/usuario')->with('msg', 'Dados atualizados com sucesso!');
        else
            return redirect('/usuario')->with('msg', 'Houve um problema ao atualizar seus dados!');
    }

    public function attDeliveryAdrress(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        if (Deliveryaddress::where('id', auth()->id())->update($data))
            return redirect('/usuario')->with('msg', 'Dados atualizados com sucesso!');
        else
            return redirect('/usuario')->with('msg', 'Houve um problema ao atualizar seus dados!');
    }

    public function saveDeliveryAdrress(Request $request)
    {
        $deliveryAddress = new Deliveryaddress();

        $deliveryAddress->id = auth()->id();
        $deliveryAddress->name = $request->name;
        $deliveryAddress->cpf = $request->cpf;
        $deliveryAddress->cep = $request->cep;
        $deliveryAddress->street = $request->street;
        $deliveryAddress->number = $request->number;
        $deliveryAddress->reference = $request->reference;

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('m/d/Y h:i:s a', time());
        $deliveryAddress->created_at = date('Y-m-d H:i:s', strtotime($date));

        if ($deliveryAddress->save()) {
            return redirect('/usuario')->with('msg', 'Dados salvos com com sucesso!');
        } else {
            return redirect('/usuario')->with('msg', 'Houve um problema ao salvar seus dados!');
        }
    }

    public function myOrders()
    {
        $pedidos = Order::with(['orderitems'])->where('user_id', auth()->id())->get();

        $total = [];

        foreach ($pedidos as $p) {
            $total[$p->id] = array();

            for ($ii = 0; $ii < count($p->orderitems); $ii++) {
                $total[$p->id][$ii] = $p->orderitems[$ii]->products->price * $p->orderitems[$ii]->amount_product;
            }
        }

        return view('user.orders', ['pedidos' => $pedidos, 'total' => $total]);
    }

    public function destroy($id)
    {
        if (User::findOrFail($id)->delete())
            return redirect('/clientes')->with('msg', 'Cliente excluído com sucesso!')->with('stts', 1);
        else
            return redirect('/clientes')->with('msg', 'Houve um problema ao excluir cliente!')->with('stts', 0);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->get();

        return view('adm.client.att', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $data = $request->all();

        if(!$request->password)
            $data['password'] = $user->password;

        if (User::findOrFail($request->id)->update($data))
            return redirect('/clientes')->with('msg', 'Cliente atualizado com sucesso!')->with('stts', 1);
        else
            return redirect('/clientes')->with('msg', 'Houve um problema ao atualizar as informações do cliente!')->with('stts', 0);
    }
}
