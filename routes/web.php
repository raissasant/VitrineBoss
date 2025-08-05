<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\Admin\ProdutoController as AdminProdutoController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\PlataformaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoriaPublicController;
use App\Http\Controllers\PlataformaPublicController;
use App\Http\Controllers\LeadController;

// ================================
// ROTAS PÚBLICAS (VITRINE)
// ================================

Route::get('/', [ProdutoController::class, 'index'])->name('home');
Route::get('/produto/{slug}', [ProdutoController::class, 'show'])->name('produto.show');
Route::get('/go/{slug}', [ProdutoController::class, 'go'])->name('produto.go');

Route::get('/categorias', [CategoriaPublicController::class, 'index'])->name('categorias.public');
Route::get('/plataformas', [PlataformaPublicController::class, 'index'])->name('plataformas.public');

Route::post('/capturar-lead', [LeadController::class, 'store'])->name('capturar.lead');



// ================================
// REDIRECIONAMENTO /DASHBOARD
// ================================
Route::redirect('/admin.dashboard', '/admin/dashboard');

// ================================
// ROTAS DE USUÁRIO AUTENTICADO
// ================================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================================
// ROTAS DO PAINEL ADMIN (RESTRITO)
// ================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/leads', [\App\Http\Controllers\Admin\LeadController::class, 'index'])->name('leads.index');

    Route::resource('produtos', AdminProdutoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('plataformas', PlataformaController::class);
});

// ================================
// AUTENTICAÇÃO (BREEZE / FORTIFY)
// ================================
require __DIR__.'/auth.php';
