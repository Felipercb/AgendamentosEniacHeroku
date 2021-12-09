<?php

use App\Http\Controllers\
{agendamentoController, 
authenticateUsersController , 
configuracoesController,
controleController,
homeController,
horariosController,
meusagendamentoscontroller,
suporteController,
testesController,
tasksController};


use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/auth/google', [authenticateUsersController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [authenticateUsersController::class, 'handleGoogleCallback' ]);

Route::group(['middleware' => ['auth']], function () {

    Route::get('/agendar', [agendamentoController::class , 'index'])->name('agendamento');
    Route::post('/agendar', [agendamentoController::class , 'store'])->name('agendamento_post');

    Route::get('/configuracoes', [configuracoesController::class , 'index'])->name('configuracoes');
    Route::post('/configuracoes', [configuracoesController::class , 'atualize'])->name('configuracoes_post');

    Route::get('/suporte', [suporteController::class , 'index'])->name('suporte');
    Route::post('/suporte/responsavel/{id}', [suporteController::class , 'responsavel'])->name('suporte_post');
    Route::get('/suporte/{id}', [suporteController::class , 'consulta'])->name('suporte_consulta');
    Route::post('/suporte/remover/{id}', [suporteController::class , 'remover_responsabilidade'])->name('suporte_post_remover');

    Route::get('/controle', [controleController::class , 'index'])->name('controle');
    Route::post('/controle/remover/{id}', [controleController::class , 'removeSuporte'])->name('removeSuporte');
    Route::post('/controle/adicionar/{id}', [controleController::class , 'adicionaSuporte'])->name('adicionaSuporte');

    Route::get('/home/agendamento/{id}', [tasksController::class , 'detalhes'] )->name('detalhes')->middleware('verificarPrivado');

    Route::get('/meusagendamentos', [meusagendamentoscontroller::class , 'index'])->name('meusagendamentos');

    Route::get('/horarios/{data}', [horariosController::class , 'index'])->name('horarios');

    Route::post('/agendar/remover/{id}', [agendamentoController::class , 'destroy'])->name('remover_agendamento_post')->middleware('userAgendamento');
    Route::get('/agendar/editar/{id}', [agendamentoController::class , 'edit'])->name('editar_agendamento_post')->middleware('userAgendamento');
    Route::post('/agendar/editar/{id}', [agendamentoController::class , 'salvarMudancas'])->name('salvar_mudancas')->middleware('userAgendamento');

    //Route::post('/admin', [agendamentoController::class , 'darAdmin']);
 

});
Route::get('/testes/{diasemana}', [testesController::class , 'testes'])->name('testes');
Route::get('/home', [tasksController::class , 'index'] )->name('home');
Route::redirect('/', 'home');