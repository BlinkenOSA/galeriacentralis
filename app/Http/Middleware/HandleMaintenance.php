<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Option;

class HandleMaintenance
{

	public function handle($request, Closure $next)
	{
		$isMaintenance = Option::first()->fields['maintenance'] ?? false;
		if (Auth::guard('twill_users')->check() == false && Route::currentRouteName() != 'en.frontpage' && $isMaintenance) {
			return redirect()->route('en.frontpage');
		}
		
		return $next($request);

	}
}
