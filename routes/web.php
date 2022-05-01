<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whichuis
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'App\Http\Controllers\PessoaController@index', ['except' => ['show']]);
Route::get('/login', 'App\Http\Controllers\PessoaController@index', ['except' => ['show']])->name('login');

Route::get('/contato/{pesId}', 'App\Http\Controllers\ContatoController@index', ['except' => ['show']])->name('consulta_contato');
Route::post('/contato/incluir/', 'App\Http\Controllers\ContatoController@create', ['except' => ['show']])->name('incluir_contato');
Route::post('/contato/excluir/{id}', 'App\Http\Controllers\ContatoController@destroy', ['except' => ['show']])->name('excluir_contato');
Route::post('/contato/alterar/', 'App\Http\Controllers\ContatoController@update', ['except' => ['show']])->name('alterar_contato');
Route::get('/pessoa', 'App\Http\Controllers\PessoaController@index', ['except' => ['show']])->name('consulta_pessoa');
Route::post('/pessoa/alterar/', 'App\Http\Controllers\PessoaController@update', ['except' => ['show']])->name('alterar_pessoa');
Route::post('/pessoa/incluir/', 'App\Http\Controllers\PessoaController@create', ['except' => ['show']])->name('incluir_pessoa');
Route::post('/pessoa/excluir/{id}', 'App\Http\Controllers\PessoaController@destroy', ['except' => ['show']])->name('excluir_pessoa');

Route::get('/home', 'App\Http\Controllers\PessoaController@index')->name('home');
Route::get('/', 'App\Http\Controllers\PessoaController@index')->name('home');


