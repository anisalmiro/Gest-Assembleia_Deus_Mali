<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\FinancialTransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rota raiz redireciona para dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// CRUD de Membros
Route::resource('members', MemberController::class);

// CRUD de Bens Patrimoniais
Route::resource('assets', AssetController::class);

// CRUD de Transações Financeiras
Route::resource('financial-transactions', FinancialTransactionController::class);

// CRUD de Despesas
Route::resource('expenses', ExpenseController::class);

//Rota do middleware de autenticação para proteger rotas
Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index']);
    // Dashboard (protegido por auth e email verificado)

    // Relatórios
    Route::prefix('reports')->group(function () {
        Route::get('/members', [DashboardController::class, 'membersReport'])->name('reports.members');
        Route::get('/members/export', [DashboardController::class, 'exportMembers'])->name('reports.members.export');

        Route::get('/assets', [DashboardController::class, 'assetsReport'])->name('reports.assets');
        Route::get('/assets/export', [DashboardController::class, 'exportAssets'])->name('reports.assets.export');

        Route::get('/financial', [DashboardController::class, 'financialReport'])->name('reports.financial');
        Route::get('/financial/export', [DashboardController::class, 'financialReportExport'])->name('reports.financial.export');
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');      // Listar usuários
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Formulário edição
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');  // Atualizar usuário


    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    // Perfil (se quiser habilitar futuramente)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas protegidas por autenticação

require __DIR__.'/auth.php';
// Rotas de autenticação
