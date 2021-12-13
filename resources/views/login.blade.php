@extends('layouts.app')
@section('body')
    <div id="login" class="fundoclaro">
        <div class="box-login flex-ac flex-jc">
            <div class="" id="logo">
                <img src="{{asset('storage/banners/bannerloginrelogio.jpg')}}" alt="LOGO" class="banners-login">
            </div>
            <form action="{{route('login.entrar')}}" method="post">
                <h1 style="margin-bottom: 18rem;">Login</h1>
                @csrf
                @method('POST')
                <fieldset class="clearfix mt-1">
                    @error('inicio')
                        <span class="error-login">{{$message}}</span>
                    @enderror    
                        <div>
                            {{-- <span class="fa fa-user"></span> --}}
                            <input type="text" Placeholder="Usuário" name="login" required autofocus>
                        </div>
                        <div>
                            {{-- <span class="fa fa-lock"></span> --}}
                            <input type="password" class="mt-1" Placeholder="Senha" name="senha" required>
                        </div>
                        <div id="entrar" class="entrar flex-jc flex-ac mt-1" style="width: 76%; gap: 1rem; margin-top: 1rem; font-size: 13px;">                 
                            <a href="{{route('cadastro.indexcad')}}" class="flex-jc botao2 flex-ac">Registre-se</a>
                            <button type="submit" class="flex-jc flex-ac botao2">Entrar</button>
                        </div>
                </fieldset>
            </form>
        </div>
    </div> 
@endsection       
