<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
	protected $modules = ['categories', 'events'];
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
	        if(config('app.env') === 'production') {
            		\URL::forceScheme('https');
        	}
		
		$this->registerHelpers();
		$this->setMorphMaps();
	}

	protected function registerHelpers()
	{
		foreach (glob(app_path().'/Inc/Helpers/*.php') as $filename){
			require_once($filename);
		}
	}

	protected function setMorphMaps()
	{
		Relation::morphMap(
			collect($this->modules)->mapWithKeys(function($module) {
				$class = 'App\Models\\' . Str::studly(Str::singular($module));
				return [$module => $class];
			})->toArray()
		);
	}
}
