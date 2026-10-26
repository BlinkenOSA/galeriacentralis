<?php

use A17\Twill\Facades\TwillRoutes;
use Illuminate\Support\Facades\Route;

// Register Twill routes here (eg. TwillRoutes::module('posts'))

Route::group(['prefix' => 'content'], function () {
	// TwillRoutes::module('pages');
});

Route::group(['prefix' => 'events'], function () {
	TwillRoutes::module('events');
	TwillRoutes::module('categories');
	TwillRoutes::module('pressItems');
});
TwillRoutes::module('options');
