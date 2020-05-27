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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*
Verb	    URI	                  Action	Route Name
GET  	    /artigos	              index	    artigos.index
GET	        /artigos/create	      create	artigos.create
POST	    /artigos	              store	    artigos.store
GET	        /artigos/{photo}	      show	    artigos.show
GET	        /artigos/{photo}/edit  edit	    artigos.edit
PUT/PATCH	/artigos/{photo}	      update	artigos.update
DELETE	    /artigos/{photo}	      destroy	admin.destroy
*/

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function(){
    //com isso abaixo eu ja tenho acesso a todas as funções do controller
    Route::resource('artigos', 'ArtigosController');
});
