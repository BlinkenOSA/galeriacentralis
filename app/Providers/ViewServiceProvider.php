<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Models\Option;
use App\Repositories\NavigationRepository;

class ViewServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		View::composer(['pages.*', 'events.*', 'blocks.*', 'partials.header',  'partials.search'], function ($view) {
			$lang = app()->getLocale();
			$view->with('lang', $lang);
		});

		View::composer(['partials.header', 'partials.footer', 'pages.info'], 'App\Http\View\Composers\HeaderComposer');
		View::composer('layouts.base', 'App\Http\View\Composers\CookiesComposer');
	}
}



