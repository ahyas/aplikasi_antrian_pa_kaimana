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
    return view('client');
});

Auth::routes();
Route::get("home","HomeController@index")->name("home.index");

//Start SSE Scripts
Route::get('server','ControllerPushMessage@server')->name('push.server');
Route::get('call','ControllerPushMessage@call');
Route::get('get_antrian','ControllerPushMessage@get_antrian')->name('push.get_antrian');
//End SSE Scripts

//Start test new client layout
Route::get("test/display", "ControllerNewLayout@index");
//End test new layout

Route::group(['middleware' => 'auth'], function () {
    //Start manage antrian sidang 
    Route::get('antrian', 'ControllerDaftarAntrian@index')->name('antrian.index');
    Route::get('antrian/get_data_perkara','ControllerDaftarAntrian@getDaftarPerkara')->name('antrian.get_data_perkara');
    Route::get('antrian/get_data_antrian','ControllerDaftarAntrian@getDaftarAntrian')->name('antrian.get_data_antrian');
    Route::get('antrian/input','ControllerDaftarAntrian@input')->name('antrian.input');
    Route::get('antrian/delete','ControllerDaftarAntrian@delete')->name('antrian.delete');
    //End manage antrian sidang
});