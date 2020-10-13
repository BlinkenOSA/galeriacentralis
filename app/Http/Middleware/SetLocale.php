<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$locale = request()->segments()[0];
		if (!empty($locale) && in_array($locale, config('translatable.locales'))) {
			app()->setLocale($locale);
		}
		
		return $next($request);

	}
}
