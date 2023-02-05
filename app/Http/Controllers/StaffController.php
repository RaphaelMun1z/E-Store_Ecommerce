<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $search = request('pesquisa');

        if (substr($search, 0, 1) == '#') {

            $staffs = Staff::where([
                ['id', substr($search, 1)]
            ])->get()[0];

            if ($staffs) {
                $staffs = User::with('staff')->where([
                    ['id', $staffs['user_id']]
                ])->orderByRaw('updated_at DESC')->get();
            }
        } elseif (substr($search, 0, 1) == '@') {

            $staffs = User::with('staff')->where([
                ['accessLevel', '>=', 1],
                ['email', 'like', '%' . substr($search, 1) . '%']
            ])->orderByRaw('updated_at DESC')->get();
           
        } elseif (substr($search, 0, 1) == '%') {

            $staffs = User::with('staff')->where([
                ['accessLevel', '>=', 1],
                ['id', substr($search, 1)]
            ])->orderByRaw('updated_at DESC')->get();

        } elseif ($search) {

            $staffs = User::with('staff')->where([
                ['accessLevel', '>=', 1],
                ['name', 'like', '%' . $search . '%']
            ])->orderByRaw('updated_at DESC')->paginate(20);
        } else {

            $staffs = User::with('staff')->where([
                ['accessLevel', '>=', 1]
            ])->orderByRaw('updated_at DESC')->paginate(20);
        }

        return view('adm.staff.index', ['staffs' => $staffs]);
    }

    // Post

    public function create(Request $request)
    {
        if ($request->_id) {

            $staff = new Staff();

            $staff->publications = $request->publications;

            date_default_timezone_set('America/Sao_Paulo');
            $date = date('m/d/Y h:i:s a', time());
            $staff->created_at = date('Y-m-d H:i:s', strtotime($date));

            $requestImage = $request->bgimage;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/adm'), $imageName);
            $staff->bgimage = $imageName;
            $staff->user_id = $request->_id;

            $requestImage = $request->profileimage;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/adm'), $imageName);
            $staff->profileimage = $imageName;

            if ($staff->save())
                return redirect('/usuario/cadastrar')->with('msg', 'Funcionário cadastrado com sucesso!')->with('stts', 1);
            else
                return redirect('/usuario/cadastrar')->with('msg', 'Houve um problema ao cadastrar o funcionário')->with('stts', 0);
        } else {
            return redirect('/')->with('msg', 'Houve um problema ao cadastrar o funcionário!')->with('stts', 0);
        }
    }

    public function destroy($id)
    {
        if (Staff::where('user_id', $id)->firstOrFail()->delete() and  User::where('id', $id)->update(array('accessLevel' => 0)))
            return redirect('/usuario/adm/funcionarios')->with('msg', 'Funcionário excluído com sucesso!')->with('stts', 1);
        else
            return redirect('/usuario/adm/funcionarios')->with('msg', 'Houve um problema ao excluir o funcionário!')->with('stts', 0);
    }

    public function update(Request $request)
    {
        $staff = Staff::where('user_id', $request->id)->get();
        $data = $request->all();

        if ($request->hasFile('profileimage') && $request->file('profileimage')->isValid()) {
            unlink(public_path('img/adm/' . $staff[0]->profileimage));
            $requestImage = $request->profileimage;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/adm'), $imageName);
            $data['profileimage'] = $imageName;
        } else {
            $data['profileimage'] = $staff[0]->profileimage;
        }

        if ($request->hasFile('bgimage') && $request->file('bgimage')->isValid()) {
            unlink(public_path('img/adm/' . $staff[0]->bgimage));
            $requestImage = $request->bgimage;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/adm'), $imageName);
            $data['bgimage'] = $imageName;
        } else {
            $data['bgimage'] = $staff[0]->bgimage;
        }

        if (Staff::findOrFail($staff[0]->id)->update($data))
            return redirect('/')->with('msg', 'Funcionário atualizado com sucesso!')->with('stts', 1);
        else
            return redirect('/')->with('msg', 'Houve um problema ao atualizar as informações do funcionário!')->with('stts', 0);
    }

    public function edit($id)
    {
        $staff = User::with('staff')->where('id', $id)->get();

        return view('adm.staff.att', ['staff' => $staff]);
    }
}
