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


Route::get('/', 'Front\FrontpageController')->name('en.frontpage');

Route::group([
	// 'prefix' => '{locale}',
	'prefix' => 'hu',
	'middleware' => ['setLocale'],
	// 'where' => ['locale' => 'hu'],
], function() {

	Route::get('/', 'Front\FrontpageController')->name('hu.frontpage');

	Route::get('kereses', 'Front\EventController@search')->name('hu.search');

	Route::get('informacio', 'Front\PageController@info')->name('hu.info');

	Route::get('sajto', 'Front\PageController@press')->name('hu.press');

	Route::prefix('{category}')->group(function() {
		Route::get('/', 'Front\EventController@index')->name('hu.events.index');
		Route::get('{slug}', 'Front\EventController@show')->name('hu.events.show');
	});



	Route::get('{slug}', 'Front\PageController@show')->name('hu.pages.show');
});

Route::get('search', 'Front\EventController@search')->name('en.search');

Route::get('info', 'Front\PageController@info')->name('en.info');

Route::get('press', 'Front\PageController@press')->name('en.press');

Route::prefix('{category}')->group(function() {
	Route::get('/', 'Front\EventController@index')->name('en.events.index');
	Route::get('{slug}', 'Front\EventController@show')->name('en.events.show');
});

Route::get('{slug}', 'Front\PageController@show')->name('en.pages.show');


Route::group([
	'prefix' => 'async'
], function() {
	Route::post('accept-cookies', 'Front\CookiesController@accept');
});