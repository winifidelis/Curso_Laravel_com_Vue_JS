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
GET  	    /admin	              index	    admin.index
GET	        /admin/create	      create	admin.create
POST	    /admin	              store	    admin.store
GET	        /admin/{photo}	      show	    admin.show
GET	        /admin/{photo}/edit  edit	    admin.edit
PUT/PATCH	/admin/{photo}	      update	admin.update
DELETE	    /admin/{photo}	      destroy	admin.destroy
*/

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function(){
    //com isso abaixo eu ja tenho acesso a todas as funções do controller
    Route::resource('artigos', 'ArtigosController');
});
