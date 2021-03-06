<?php

namespace App\Http\Controllers;

use App\Models\ImagemUsuario;
use App\Models\MeusDados;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class MeusDadosController extends Controller
{
    public function index(){
        $dados              = new stdClass;
        $dados->user        = Auth::user();
        $dados->meusDados   = MeusDados::where('codusuario', $dados->user->id)->first();
        $img                = ImagemUsuario::where('controle')->first();
        return view('admin.meusdados', compact('dados', 'img'));
    }

    public function cadastro(Request $request){
        // dd($request);
        $meusDados                      = new MeusDados();
        $meusDados->codusuario          = Auth::user()->id;
        $meusDados->nomeusuario         = $request->get('nome');
        $meusDados->sobrenomeusuario    = $request->get('sobrenome');
        $meusDados->cpf                 = preg_replace('/[^0-9]/', '', $request->get('cpf'));
        $meusDados->rg                  = preg_replace('/[^0-9]/', '', $request->get('rg'));
        $meusDados->cargo               = $request->get('cargo');
        $meusDados->datanascimento      = $request->get('datanascimento');
        $meusDados->dataadmissao        = $request->get('dataadmissao');
        $meusDados->datarescisao        = $request->get('datarescisao');
        $meusDados->nomepai             = $request->get('nomepai');
        $meusDados->nomemae             = $request->get('nomemae');
        $meusDados->save();
        if($request->hasfile('image')){
            foreach ($request->file('image') as $file) {
                $image = 'user/' . generateRandomString(10) . '.jpg';
                $file->move(public_path('storage').'\user',$image);
                $galeria = new ImagemUsuario();
                $galeria->descricaoimg = $image;
                $galeria->codusuario = $meusDados->codusuario;
                $galeria->ativo = "1";
                $galeria->save();
            }
        }
        return redirect()->back()->withInput()->with(['admin.meusdados' => 'Meus dados salvado com sucesso !']); 
    }

    public function deleteImg($id){
        $img = ImagemUsuario::where('controle', $id)->first();
        $img->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function deleteAllImg(){
        $imgs = ImagemUsuario::get();
        foreach ($imgs as $img) {
            $img->delete();
        }
        return response()->json([
            'status' => 'success'
        ]);
    }
}
