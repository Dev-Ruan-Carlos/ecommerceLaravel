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
            return redirect()->route('controleuser.listagem');
        }else{
            if(User::where('email', $request->get('emailCadastro'))->orWhere('nome', $request->get('loginCadastro'))->count() > 0 ){
                return redirect()->back()->withInput()->withErrors(['cadastro' => 'Usuário/E-mail já cadastrado, tente novamente!']);
            }else{
            $user = new User();
            $user->nome = $request->get('loginCadastro');
            $user->email = $request->get('emailCadastro');
            $user->password = bcrypt($request->get('password')); 
            $user->nivel_acesso = 3;
            $user->nome_acesso = 'limitado';
            $user->ativo = 0;
            $user->save();
            return redirect()->back()->withInput()->withErrors(['cadastro' => 'Usuário cadastrado com sucesso!']);
            }
        }
    }
}
