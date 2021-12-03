<?php

use App\Http\Controllers\admin\CatalogoController;
use App\Http\Controllers\CadastroProdutoController;
use App\Http\Controllers\CadastroUserController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EspeciePagamentoController;
use App\Http\Controllers\FinalizacaoController;
use App\Http\Controllers\GerencialController;
use App\Http\Controllers\HistoricoCompraController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginPagamentoController;
use App\Http\Controllers\PedidoController;
use App\Models\Carrinho;
use App\Models\CarrinhoItem;
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

Route::prefix('admin')->group(function(){
    Route::get('gerencial',[GerencialController::class, 'index'])->name('admin.gerencial');
    Route::get('chart-produtos-mais-vendidos',[GerencialController::class, 'chartProdutosMaisVendidos'])->name('admin.gerencial.chartprodutomaisvendidos');
    Route::get('chart-produtos-mais-lucrativos',[GerencialController::class, 'chartProdutosMaisLucrativos'])->name('admin.gerencial.chartprodutomaislucrativos');
    Route::prefix('catalogo')->group(function(){
        Route::get('/', [CatalogoController::class, 'index'])->name('admin.catalogo');
        Route::get('indexcadastro', [CatalogoController::class, 'indexcadastro'])->name('admin.catalogo.indexcadastro');
        Route::post('cadastro', [CatalogoController::class, 'cadastro'])->name('admin.catalogo.cadastro');
        Route::get('allProdutos/{id}', [CatalogoController::class, 'allProdutos'])->name('admin.catalogo.allProdutos');
        Route::delete('deleteImg/{id}', [CatalogoController::class, 'deleteImg'])->name('admin.catalogo.deleteImg');
        Route::delete('deleteAllImg', [CatalogoController::class, 'deleteAllImg'])->name('admin.catalogo.deleteAllImg');
        Route::get('get', [CatalogoController::class, 'get'])->name('admin.catalogo.get');
    });
    Route::prefix('cliente')->group(function(){
        Route::get('/', [ClienteController::class, 'index'])->name('admin.cliente');
        Route::get('index', [ClienteController::class, 'indexCliente'])->name('admin.cliente.indexCliente');
        Route::get('cadastro', [ClienteController::class, 'cadastro'])->name('admin.cliente.cadastro');
        Route::get('allClientes/{id}', [ClienteController::class, 'allClientes'])->name('admin.cliente.allClientes');
        Route::get('get', [ClienteController::class, 'get'])->name('admin.cliente.get');
    });
    Route::prefix('pedido')->group(function(){
        Route::get('/', [PedidoController::class, 'index'])->name('admin.pedido');
        Route::get('get', [PedidoController::class, 'get'])->name('admin.pedido.get');
    });
});

Route::prefix('login')->group(function(){
    Route::get('/', [LoginController::class, 'index'])->name('login.indexlog');
    Route::post('entrar', [LoginController::class, 'entrar'])->name('login.entrar');
});

Route::prefix('buscainicio')->group(function(){
    Route::get('buscarProdutos', [InicioController::class, 'buscarProdutos'])->name('buscainicio.buscar');
}); 

Route::prefix('carrinho')->group(function(){
    Route::get('prodCarrinho', [CarrinhoController::class, 'prodCarrinho'])->name('prodcarrinho');
    Route::get('acesso', [CarrinhoController::class, 'accessInfo'])->name('acesso');
    Route::get('adicionaritem/{id}', [CarrinhoController::class, 'adicionaritem'])->name('carrinho.adicionaritem');
    Route::get('incrementarItem/{id}', [CarrinhoController::class, 'incrementarItem'])->name('incrementarItem');
    Route::get('delimitarItem/{id}', [CarrinhoController::class, 'delimitarItem'])->name('delimitarItem');
    Route::get('deletarItem/{id}', [CarrinhoController::class, 'deletarItem'])->name('deletarItem');
    Route::get('quantidades', [CarrinhoController::class, 'quantidades'])->name('quantidades');
    Route::get('salvar', [CarrinhoController::class, 'salvar'])->name('salvar');
});

Route::prefix('pagamento')->group(function(){
    Route::get('formaPagamento/{id}', [EspeciePagamentoController::class, 'formaPagamento'])->name('formaPagamento');
    Route::post('finalizarcompra/{id}', [EspeciePagamentoController::class, 'salvarFormaPagamento'])->name('pagamento.finalizarCompra');
});

Route::prefix('historico')->group(function(){
    Route::get('/', [HistoricoCompraController::class, 'index'])->name('historico.index');
    Route::get('detalhe/{id}', [HistoricoCompraController::class, 'detalhe'])->name('historico.detalhe');
});

Route::prefix('finalizacao')->group(function(){
    Route::get('indexFinalizacao/{id}', [FinalizacaoController::class, 'indexFinalizacao'])->name('indexFinalizacao');
    Route::get('cancelarPedido/{id}', [FinalizacaoController::class, 'cancelarPedido'])->name('cancelarPedido');
});
