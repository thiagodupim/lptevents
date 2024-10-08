<?php

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

use App\Http\Controllers\EventController; /*Aqui estamos importando o controller da action index*/
use App\Http\Controllers\ContactController;
use GuzzleHttp\Middleware;

Route::get('/', [EventController::class, 'index']); /* Aqui agente está dizendo que vai usar o EventController que criamos, e também a rota index*/

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/events/create', [EventController::class, 'create'])->middleware('auth'); 
    /*Esse é o nome do método que vamos utilizar la na classe de controller pra poder criar um evento no nosso projeto, e o middleware('auth') é para que possamos acessar a view de criar eventos somente depois de logado*/
});

Route::get('/events/{id}', [EventController::class, 'show']);/*Usamos o show para mostrar um dado especifico*/


Route::post('/events', [EventController::class, 'store']); /*O metodo store é para lógica de adição de dados*/

Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth'); /*Usamos o delete e o destroy para deletar*/  

Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth'); 

Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');

Route::any('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');

Route::get('/contatos', [ContactController::class, 'create']);  

Route::post('/contatos', [ContactController::class, 'store'])->middleware('auth');

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

Route::get('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');

Route::delete('/events/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');

Route::get('/inscricao', function () {
    return view('enrollment');
})->middleware('auth');

Route::get('event/cancellation/{id}', [EventController::class, 'tripCancellation'])->name('trip.Cancellation');

Route::post('event/cancel-trip/{id}', [EventController::class, 'cancelTrip'])->name('trip.cancel');

Route::get('event/list-subscribers', [EventController::class, 'listSubscribers'])->name('list.subscribers');