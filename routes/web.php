<?php

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
    return view('home');
});

Route::get('/ad', function () {
    return view('layouts.admin');
});

/*Route::get('/passwords/reset', function () {
    return view('auth.passwords.reset');
});*/

/*Route::get('/userhome', function () {
    return view('ark.userHome');
});*/
Route::get('/userhome', 'UserHomeController@index');
Route::get('/myProfile/{id}', 'UserHomeController@edit');
Route::patch('/myProfile/{id}', 'UserHomeController@updateSelf');
Route::get('/currencyConverter', 'CurrencyController@index');
Route::get('/manageUser', 'UserController@index');
Route::post('/converted', 'CurrencyController@show')->middleware('currency');
Route::get('/roles', 'RoleController@index');
Route::get('/searchMembers','UserController@search');
Route::get('/editMember/{id}','UserController@edit');
Route::patch('/editMember/{id}','UserController@update');
Route::resource('dinos', 'DinoController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();
    dd($user->hasRole('Owner'));
});

Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();
    dd($user->can('delete'));
});
Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();
    dd($user->can('view'));
});


Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();
    $user->givePermission();
});

Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();
    $user->removePermission('delete');
});

Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();
    $user->givePermission('delete');
});
Route::get('/', function (\Illuminate\Http\Request $request) {
    $user = $request->user();
    $user->modifyPermission('delete');
});*/

