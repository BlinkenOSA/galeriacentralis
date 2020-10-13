<?php

// Register Twill routes here (eg. Route::module('posts'))

Route::group(['prefix' => 'content'], function () {
	// Route::module('pages');
});

Route::group(['prefix' => 'events'], function () {
	Route::module('events');
	Route::module('categories');
	Route::module('pressItems');
});
Route::module('options');
