@extends('layouts.app')
@section('body')
<form action="{{route('admin.cliente.cadastro')}}" method="POST">
    @csrf 
    @method('POST')
    <input type="text" name="id" @isset($allclientes) value="{{$allclientes->id}}" @endisset hidden>
    <section class="container mt-6 flex-c flex-ac">
        @error('admin.catalogo.allClientes')
            <span class="error">{{$message}}</span>
        @enderror 
        @error('admin.catalogo.indexcadastro')
            <span class="error">{{$message}}</span>
        @enderror  
        @if(session()->has('admin.catalogo.allProdutos'))
            <div class="alert alert-success">
                {{ session()->get('admin.catalogo.allProdutos') }}
            </div>
        @endif 
        <div class="flex-r flex-jc flex-c">
            <div class="body-card-principal-cliente">
                
            </div>
            <div class="body-card-principal-cliente">
                
            </div>
        </div>
    </section>
</form>
@endsection 