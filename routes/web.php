<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstoqueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redireciona a raiz direto para o dashboard
Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// ------------------------------------------------------------------------
// Rotas do Dashboard e Estoque (CRUD na mesma tela, sem login)
// ------------------------------------------------------------------------

Route::get('/dashboard', [EstoqueController::class, 'index'])->name('dashboard.index');
Route::post('/estoque', [EstoqueController::class, 'store'])->name('estoque.store');
Route::put('/estoque/{estoque}', [EstoqueController::class, 'update'])->name('estoque.update');
Route::delete('/estoque/{estoque}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');