<?php

use App\Http\Controllers\CadastroProdutoController;
use App\Http\Controllers\CadastroUserController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\FinalizacaoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginPagamentoController;
use App\Models\Carrinho;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [InicioController::class, 'index'])->name('inicio');   

Route::prefix('cadastro')->group(function(){
    Route::get('/', [CadastroUserController::class, 'index'])->name('cadastro.indexcad');
    Route::post('registre', [CadastroUserController::class, 'gravar'])->name('cadastro.registre');
});

Route::prefix('login')->group(function(){
    Route::get('/', [LoginController::class, 'index'])->name('login.indexlog');
    Route::post('entrar', [LoginController::class, 'entrar'])->name('login.entrar');
});

Route::prefix('produto')->group(function(){
    Route::get('/', [CadastroProdutoController::class, 'index'])->name('produto.indexproduto');
    Route::post('cadproduto', [CadastroProdutoController::class, 'cadProduto'])->name('produto.cadproduto');
});

Route::prefix('buscainicio')->group(function(){
    Route::post('buscarProdutos', [InicioController::class, 'buscarProdutos'])->name('buscainicio.buscar');
}); 

Route::prefix('carrinho')->group(function(){
    Route::get('prodCarrinho', [CarrinhoController::class, 'prodCarrinho'])->name('prodcarrinho');
    Route::get('acesso', [CarrinhoController::class, 'accessInfo'])->name('acesso');
    Route::get('adicionaritem/{id}', [CarrinhoController::class, 'adicionaritem'])->name('carrinho.adicionaritem');
    Route::get('quantidades', [CarrinhoController::class, 'quantidades'])->name('quantidades');
});

Route::prefix('loginFinalizacao')->group(function(){
    Route::get('loginPagamento', [LoginPagamentoController::class, 'loginPagamento'])->name('loginPagamento');
    Route::post('entrarPagamento', [LoginPagamentoController::class, 'entrarPagamento'])->name('entrarPagamento');
});

Route::prefix('finalizacao')->group(function(){
    Route::post('indexFinalizacao', [FinalizacaoController::class, 'indexFinalizacao'])->name('indexFinalizacao');
});
