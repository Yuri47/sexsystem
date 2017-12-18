<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/search', function () {
 //   return view('search');
//});
Route::post('searchCode', 'SearchController@makeSearch');
Route::post('modifyPrice', 'SearchController@modifyPrice');
Route::post('logDev', 'SearchController@logDev');

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/data', 'SearchController@getData');
Route::get('/cad', 'SearchController@cad');


Route::get('/search', [
    'middleware' => 'auth',
    'uses' => 'SearchController@returnView'
]);