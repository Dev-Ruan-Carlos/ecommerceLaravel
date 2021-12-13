<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CadastroUserController extends Controller
{
    public function index(){
        return view('cadastrouser');
    }


    public function gravar(Request $request){
        if($request->get('id')){
            $usuarios = User::where('id',$request->get('id'))->first();
            $usuarios->nivel_acesso = $request->post('acesso');
            switch ($request->post('acesso')) {
                case '1':
                    $usuarios->nome_acesso = 'administrador';
                    break;
                case '2':
                    $usuarios->nome_acesso = 'supervisor';
                    break;
                case '3':
                    $usuarios->nome_acesso = 'limitado';
                    break;
                default:
                    $usuarios->nome_acesso = 'limitado';
                    break;
            }
            $usuarios->ativo = $request->post('status');
            $usuarios->save();
            return redirect()->back()->with(['admin.cliente.allClientes' => 'Usuário alterado com sucesso!']);
        }else{
            if(User::where('email', $request->get('email'))->orWhere('nome', $request->get('nome'))->count() > 0 ){
                return redirect()->back()->withInput()->withErrors(['admin.cliente.allClientes' => 'Usuário/E-mail já cadastrado, tente novamente!']);
            }else{
            $user = new User();
            $user->nome = $request->get('nome');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('senha')); 
            $user->nivel_acesso = 3;
            $user->nome_acesso = 'limitado';
            $user->ativo = 0;
            $user->save();
            return redirect()->back()->with(['admin.cliente.allClientes' => 'Usuário cadastrado com sucesso!']);
            }
        }
    }
}
