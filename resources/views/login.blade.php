@extends('layouts.app')
@section('body')
    <div id="login" class="fundoazul">
        <div class="box-login flex-ac">
            <form action="{{route('login.entrar')}}" method="post">
                @csrf
                @method('POST')
                <fieldset class="clearfix">
                    @error('inicio')
                        <span class="error">{{$message}}</span>
                    @enderror    
                        <p>
                            <span class="fa fa-user"></span>
                            <input type="text"  Placeholder="Usuário" name="login" required autofocus>
                        </p>
                        <p>
                            <span class="fa fa-lock"></span>
                            <input type="password"  Placeholder="Senha" name="senha" required>
                        </p> 
                        <div id="entrar" class="entrar flex-jc mt-05">                 
                            <button type="submit" class="button">Entrar</button>
                        </div>
                        <div class="white mt-1">
                            <a href="{{route('cadastro.indexcad')}}" class="flex-jc">Registre-se</a>
                            <section class="flex-jc mt-05">
                                <p>
                                <a href="{{route('inicio')}}">Voltar a tela inicial</a>
                            </section>
                        </div>
                </fieldset>
            </form>
            <div class="logo" id="logo">
                <img src="{{asset('img/logo.jpg')}}" alt="LOGO">
            </div>
        </div>
    </div> 
@endsection       
