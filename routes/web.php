<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SynthstucController;
use App\Models\Synthstuc;
use App\Http\Controllers\SynthstutController;
use App\Models\Synthstut;
use App\Http\Controllers\SynthstueController;
use App\Models\Synthstue;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', function (Synthstuc $synthstuc, Synthstut $synthstut) {

    return view('dashboard.home');
});

// Route::get('/test', function() {
//     return view('dashboard.home');
// });

// Route::get('register', 'App\Http\Controllers\Auth\RegisteredUserController@create' )->name('register')->middleware('admin');
// Route::get('/test', function() {
//     return view('auth.register');
// });

Route::get('/index', function () {
    return view('dashboard.index');
})->name('dashboard.index');


Route::group(['middleware' => 'can:isFormatriceOrAdmin'], function() {
    // synthstuc
    Route::get('synthstucs/createWithId/{id}', 'App\Http\Controllers\SynthstucController@createWithId')->name('synthstucs.createWithId');
    Route::post('synthstucs/storeWithId/{id}', 'App\Http\Controllers\SynthstucController@storeWithId')->name('synthstucs.storeWithId');
    Route::get('synthstucs/showSynth/{id}/{id2}', 'App\Http\Controllers\SynthstutController@showSynth')->name('synthstucs.showSynth');
    Route::get('users/indexTUC/{id}', 'App\Http\Controllers\UserController@indexTUC')->name('users.indexTUC');
    // synthstut
    Route::get('synthstuts/createWithId/{id}', 'App\Http\Controllers\SynthstutController@createWithId')->name('synthstuts.createWithId');
    Route::post('synthstuts/storeWithId/{id}', 'App\Http\Controllers\SynthstutController@storeWithId')->name('synthstuts.storeWithId');
    Route::get('synthstuts/showSynth/{id}/{id2}', 'App\Http\Controllers\SynthstutController@showSynth')->name('synthstuts.showSynth');
    Route::get('users/indexTUT/{id}', 'App\Http\Controllers\UserController@indexTUT')->name('users.indexTUT');
    // synthstue
    Route::get('synthstues/createWithId/{id}', 'App\Http\Controllers\SynthstueController@createWithId')->name('synthstues.createWithId');
    Route::post('synthstues/storeWithId/{id}', 'App\Http\Controllers\SynthstueController@storeWithId')->name('synthstues.storeWithId');
    Route::get('synthstues/showSynth/{id}/{id2}', 'App\Http\Controllers\SynthstueController@showSynth')->name('synthstues.showSynth');
    Route::get('users/indexTUE/{id}', 'App\Http\Controllers\UserController@indexTUE')->name('users.indexTUE');
    // users
    Route::get('users/indexUserCreated/{id}', 'App\Http\Controllers\UserController@indexUserCreated')->name('users.indexUserCreated');
    // Route::get('users/validSign', 'App\Http\Controllers\UserController@valid_sign')->name('valid_sign');
    Route::post('users/validSign', 'App\Http\Controllers\UserController@valid_sign')->name('valid_sign');
  });

// ressource
Route::resource('synthstucs', SynthstucController::class);
Route::resource('synthstuts', SynthstutController::class);
Route::resource('synthstues', SynthstueController::class);
Route::resource('users', UserController::class);

Route::get('/TuC_CV/{file}', function ($file) {
    // file path
   $path = public_path('storage/file' . '/' . $file);
    // header
   $header = [
     'Content-Type' => 'application/TuC_CV',
     'Content-Disposition' => 'inline; filename="' . $file . '"'
   ];
  return response()->file($path, $header);
})->name('TuC_CV');

Route::get('/TuE_CV/{file}', function ($file) {
    // file path
   $path = public_path('storage/file' . '/' . $file);
    // header
   $header = [
     'Content-Type' => 'application/TuE_CV',
     'Content-Disposition' => 'inline; filename="' . $file . '"'
   ];
  return response()->file($path, $header);
})->name('TuE_CV');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';

// synthstuc
Route::get('/search_form', [SynthstucController::class, 'search'])->name('search');
Route::get('/search_tuc', 'App\Http\Controllers\SynthstucController@search_tuc')->name('search_tuc');
Route::post('/init_tuc', 'App\Http\Controllers\SynthstucController@init_tuc')->name('init_tuc');
Route::get('/ma_synthes_tuc', 'App\Http\Controllers\SynthstucController@ma_synthes_tuc')->name('ma_synthes_tuc');
Route::get('/synthstucs/create/{id}', 'App\Http\Controllers\SynthstucController@synthstucs_create')->name('synthstucs_create');

// synthstue
Route::get('/search_form', [SynthstueController::class, 'search'])->name('search');
Route::get('/search_tue', 'App\Http\Controllers\SynthstueController@search_tue')->name('search_tue');
Route::post('/init_tue', 'App\Http\Controllers\SynthstueController@init_tue')->name('init_tue');
Route::get('/ma_synthes_tue', 'App\Http\Controllers\SynthstueController@ma_synthes_tue')->name('ma_synthes_tue');
Route::get('/synthstues/create/{id}', 'App\Http\Controllers\SynthstueController@synthstues_create')->name('synthstues_create');

Route::get('/admin', function () {
    return view('dashboard.admin');
})->middleware(['auth'])->name('admin');
Route::get('/search_log', 'App\Http\Controllers\SynthstucController@search_log')->name('search_log');

// synthstut
Route::get('/search_tut', 'App\Http\Controllers\SynthstutController@search_tut')->name('search_tut');
Route::post('/init_tut', 'App\Http\Controllers\SynthstutController@init_tut')->name('init_tut');
Route::get('/ma_synthese_tut', 'App\Http\Controllers\SynthstutController@ma_synthese_tut')->name('ma_synthese_tut');
Route::get('/synthstuts/create/{id}', 'App\Http\Controllers\SynthstutController@synthstuts_create')->name('synthstuts_create');
Route::get("/validation", 'App\Http\Controllers\SynthstutController@validation')->name('validation');
Route::post('/valid', 'App\Http\Controllers\SynthstutController@valid')->name('valid');

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'App\Http\Controllers\MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'App\Http\Controllers\MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'App\Http\Controllers\MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'App\Http\Controllers\MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'App\Http\Controllers\MessagesController@update']);
});

Route::get('/downloadPDF','App\Http\Controllers\UserController@downloadPDF')->name('downloadPDF');
Route::get('/pdf/{id}', 'App\Http\Controllers\UserController@pdf_log')->name('pdf_log');
