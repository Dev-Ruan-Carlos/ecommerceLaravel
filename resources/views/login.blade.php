@extends('layouts.app')
@section('body')
    <div id="login" class="fundoclaro">
        <div class="box-login flex-ac flex-jc">
            <form action="{{route('login.entrar')}}" method="post" class="p-2 w-100 h-100">
                <div class="flex-ac flex-jc flex-c w-100 h-100">
                    <div>
                        <i class="fas fa-users mb-1" style="font-size: 5rem; color: #2a3b4d;"></i>
                    </div>
                    <h1 class="mb-1">Mini e-commerce</h1>
                    {{-- <h2 class="mt-1 mb-1">Login</h2> --}}
                    @csrf
                    @method('POST')
                    <fieldset class="flex-ac flex-jc flex-c w-100">
                        @error('inicio')
                            <span class="error-login">{{$message}}</span>
                        @enderror    
                            <div class="w-100 field">
                                <label class="label" for="login mb-1">Login</label>
                                {{-- <i class="fas fa-user-tie iconeInput"></i> --}}
                                <input type="text" class="inputPadrao cl-12 mt-1" name="login" required>
                            </div>
                            <div class="w-100 field">
                                <label class="label" for="senha">Senha</label>
                                {{-- <i class="fas fa-unlock iconeInput"></i> --}}
                                <input type="password" class="inputPadrao cl-12 mt-1" name="senha" required>
                            </div>
                            <div id="entrar" class="entrar flex-se mt-2 w-100">                 
                                <a href="{{route('cadastro.indexcad')}}" class="flex-jc botao flex-ac">Registre-se</a>
                                <button type="submit" class="flex-jc flex-ac botao">Entrar</button>
                            </div>
                    </fieldset>
                </div>
            </form>
        </div>
        {{-- <div class="" id="logo">
            <img src="{{asset('storage/banners/bannerloginrelogio.jpg')}}" alt="LOGO" class="banners-login">
        </div> --}}
    </div> 
@endsection       
