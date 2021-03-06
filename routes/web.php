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

Route::get('/', 'ShortLinkController@create');
Route::post('/link', 'ShortLinkController@store');
Route::get('/delete/{shortLink}/{passwd}', 'ShortLinkController@destroy');

Route::get('/legal', 'StaticController@legal');

Route::resource('report', 'ReportController')->only(['create', 'store']);
Route::resource('report', 'ReportController')->only(['index', 'destroy'])->middleware('auth');

Route::get('/admin', 'AdminController@show');
Route::post('/login', 'AdminController@login');

// i18n system
Route::get('/language.json', 'LocaleController@getJSON')->name('localejson');
Route::get('/language/{lang}', 'LocaleController@setLocale')->name('setlocale');

Route::get('/{slug}', 'ShortLinkController@show');
