<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsuarioContato;
use App\Models\UsuarioEndereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ClienteController extends Controller
{
    public function index(){
        $dados = new stdClass;
        $dados->user = Auth::user();
        return view('admin.cliente', compact('dados'));
    }

    public function indexCliente(){
        $dados = new stdClass;
        $dados->user = Auth::user();
        return view('admin.cadastrocliente', compact('dados'));
    }

    public function cadastro(Request $request){
        if($request->get('id')){
            $usuarios = User::where('id',$request->get('id'))->first();
            $usuarios->nome = $request->get('nome');
            $usuarios->email = $request->get('email');
            $usuarios->nivel_acesso = $request->get('nivelAcesso');
            switch ($request->post('nivelAcesso')) {
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
            $usuarios->ativo = 1;
            $usuarios->save();
            return redirect()->back()->withInput()->withErrors(['admin.cliente.allClientes' => 'Cadastro do cliente alterado com sucesso !']);  
        }else{
            if(User::where('email', $request->get('email'))->orWhere('nome', $request->get('login'))->count() > 0 ){
                return redirect()->back()->withInput()->withErrors(['cadastro' => 'Usuário/E-mail já cadastrado, tente novamente!']);
            }else{
                $user = new User();
                $user->nome = $request->get('nome');
                $user->email = $request->get('email');
                $user->password = bcrypt($request->get('senha')); 
                $user->nivel_acesso = 3;
                $user->nome_acesso = 'limitado';
                $user->ativo = 1;
                $user->save();
                    $userContato = new UsuarioContato();
                    $userContato->codusuario = $user->id;
                    $userContato->celular = $request->get('celular');
                    $userContato->telefone = $request->get('telefone');
                    $userContato->email = $request->get('email');
                    $userContato->save();
                        $userEndereco = new UsuarioEndereco();
                        $userEndereco->codusuario = $user->id;
                        $userEndereco->cep = $request->get('cep');
                        $userEndereco->rua = $request->get('rua');
                        $userEndereco->bairro = $request->get('bairro');
                        $userEndereco->numero = $request->get('numero');
                        $userEndereco->uf = $request->get('uf');
                        $userEndereco->cidade = $request->get('cidade');
                        $userEndereco->save();
                return redirect()->back()->withInput()->withErrors(['cadastro' => 'Usuário cadastrado com sucesso!']);
            }
        }
    }

    public function allClientes($id){
        $dados = new stdClass;
        $dados->user = Auth::user();
        $allclientes = User::where('id', $id)->first();
        return view('admin.cadastrocliente', compact('allclientes', 'dados'));
    }

    public function get(){
        $clientes = User::get();
        return Datatables()->of($clientes)
        ->addColumn('acoes', function ($clientes){
            $botao = '<a href='. route('admin.cliente.allClientes', $clientes->id) .' data-tooltip="Editar clientes" data-tooltip-location="left">';
                $botao .= '<svg width="18px" height="18px" viewBox="0 0 4233 4233">';
                    $botao .= '<g id="Camada_x0020_1">';
                        $botao .= '<g id="_1913567360560">';
                            $botao .= '<path class="fill-blue" d="M454 4233l2721 0c251,0 454,-203 454,-453l0 -1512c0,-84 -68,-151 -152,-151 -83,0 -151,67 -151,151l0 1512c0,83 -67,151 -151,151l-2721 0c-84,0 -152,-68 -152,-151l0 -3024c0,-84 68,-151 152,-151l1814 0c83,0 151,-68 151,-151 0,-84 -68,-152 -151,-152l-1814 0c-251,0 -454,203 -454,454l0 3024c0,250 203,453 454,453z"/>';
                            $botao .= '<path class="fill-blue" d="M3850 774l-1965 1966 -588 196 196 -586 1966 -1966c108,-108 283,-108 391,0 52,52 81,122 81,195 0,73 -29,144 -81,195zm383 -193l0 -5c0,-147 -57,-294 -169,-406 -109,-109 -256,-170 -409,-170 -154,0 -301,61 -410,170l-1991 1991c-17,17 -29,37 -37,59l-302 907c-26,79 16,165 96,191 15,6 31,8 47,8 17,0 33,-2 48,-8l907 -302c23,-7 43,-20 59,-36l1992 -1992c112,-112 169,-259 169,-407z"/>';
                        $botao .= '</g>';
                    $botao .= '</g>';
                $botao .= '</svg>';
            $botao .= '</a>';
            return $botao;
        })->rawColumns(['acoes'])
        ->make(true);
    }
}
