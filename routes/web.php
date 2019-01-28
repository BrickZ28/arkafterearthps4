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
/*Route::get('/tribespvp', function () {
    return view('partials.tribespvp');
});*/

Route::get('/myTransactions', 'UserController@myTransactions');
Route::get('/payForDino/{id}','DinoController@payForDino');
Route::patch('/user/bank/transaction/{id}', 'UserController@userToBankFundsTransaction');
Route::patch('/user/user/transaction', 'UserController@userToUserFundsTransaction');
Route::get('/manageMyFunds', 'UserController@fundsManage');
Route::post('/sendpin', 'UserController@sendpin');
Route::get('/myRequests', 'DinoController@myRequests');
Route::get('/pveDinos', 'DinoController@pveDinos');
Route::get('/pvpDinos', 'DinoController@pvpDinos');
Route::get('/dinoRequests/completed', 'DinoController@dinoRequestsCompleted');
Route::delete('/users/{id}', 'UserController@destroy');
Route::get('/currencyEditor', 'ExchangeRateController@currencyEditor');
Route::get('/dinos/requestDino/{id}', 'DinoController@requestDino');
Route::get('/dinoRequests', 'DinoController@dinoRequests');
Route::get('/dinoRequestView/{id}', 'DinoController@dinoRequestView');
Route::patch('/dinoRequestEdit/{id}', 'DinoController@dinoRequestEdit');
Route::get('/dinos/request/send/{id}', 'DinoController@requestDinoSend');
Route::get('/userhome', 'UserHomeController@index');
Route::get('/myProfile/{id}', 'UserHomeController@edit');
Route::patch('/myProfile/{id}', 'UserHomeController@updateSelf');
Route::get('/currencyConverter', 'CurrencyController@index');
Route::get('/manageUser', 'UserController@index');
Route::post('/converted', 'CurrencyController@show')->middleware('currency');
Route::resource('/roles', 'RoleController');
Route::resource('/permissions', 'PermissionController');
Route::get('/searchMembers','UserController@search');
Route::get('/searchToSend','UserController@searchToSend');
Route::get('/searchTransactions','BankTransactionController@searchTransactions');
Route::get('/searchDinos','DinoController@searchDino');
Route::get('/searchDinoRequests','DinoController@searchRequest');
Route::get('/editMember/{id}','UserController@edit');
Route::patch('/editMember/{id}','UserController@update');
Route::resource('dinos', 'DinoController');
Route::resource('exchangeRates', 'ExchangeRateController');
Route::resource('bank', 'BankController');
Route::resource('transactions', 'BankTransactionController');


Auth::routes(['verify' => true]);

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

