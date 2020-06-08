<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/redirect', 'Auth\LoginController@redirectToGoogle');
Route::get('/callback', 'Auth\LoginController@handleGoogleCallback');
Route::get('lang/{locale}','LanguageController')->name('lang');

Route::get('/', function () {
    if(!Auth::check()) {
        return view('welcome');
    }else{
        if(Auth::user()->last_tracker_id) {
            return redirect()->route('tracker.show', Auth::user()->last_tracker_id);
        }else{
            return redirect()->route('user.index');
        }
    }
});

Auth::routes();

Route::get('user/edit', 'UserController@edit_mortal')->name('user.edit_mortal');
Route::resource('user', 'UserController');

Route::resource('tracker', 'TrackerController');

Route::resource('tracker/participant', 'ParticipantController');

Route::resource('tracker/income', 'IncomeSourceController');

Route::resource('tracker/expense', 'ExpenseCategoryController');

Route::resource('transaction', 'TransactionController');

