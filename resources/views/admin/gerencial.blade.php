@extends('layouts.appadmin')
@section('body')
    <section class="container">
        <hgroup>
            <h1>Gerencial</h1>
            <h2>Estatística gerencial de uso</h2>
        </hgroup>
        <div class="body-card">
            <div class="card">
                @include('admin.includes.cardprodutos')
            </div>
            <div class="card">
                @include('admin.includes.cardclientes')
            </div>
            <div class="card">
                @include('admin.includes.cardvendas')
            </div>
        </div>
        <div class="body-chart">
            @include('admin.includes.chartprodutomaisvendido')
            @include('admin.includes.chartprodutomaislucrativos')
        </div>
    </section>
@endsection 