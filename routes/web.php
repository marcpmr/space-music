<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

//Route::get('/login', [LoginController::class, 'index'])->name('login');

//Route::get('/login', function () {
    //return redirect()->route('login');
//});



Route::get('/', function () {
    return redirect('/search');
});

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::any('/search',function(){
    $q = Request::input( 'q' );
    return App::call('App\Http\Controllers\HomeController@index' , ['q' => $q]);
});

Route::any('/favouritelist',function(){
    $q = Request::input( 'list_name' );
    return App::call('App\Http\Controllers\FavouritelistController@store' , ['list_name' => $q]);
});

Route::any('/addFavouriteToList',function(){
    $favourite = Request::input( 'favourite_name' );
    $songID = Request::input( 'song_id' );
    return App::call('App\Http\Controllers\FavouriteController@store' , ['favourite_name' => $favourite, 'song_id' => $songID]);
});

Route::any('/DeleteFavouriteInList',function(){
    $songID = Request::input( 'song_id' );
    return App::call('App\Http\Controllers\FavouriteController@destroy' , ['song_id' => $songID]);
});

Route::any('/DeleteFavouriteList',function(){
    $ID = Request::input( 'id' );
    return App::call('App\Http\Controllers\FavouriteListController@destroy' , ['id' => $ID]);
});




Route::get('/search/{q}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
