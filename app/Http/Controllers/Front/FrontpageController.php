<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use \App\Inc\Traits\HandleMeta;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;

class FrontpageController extends Controller
{
	use HandleMeta;

	public function __invoke(Request $request)
	{
		$isMaintenance = Option::first()->fields['maintenance'] ?? false;

		if ($isMaintenance && Auth::guard('twill_users')->check() == false) {
			return view('frontpage.empty');
		}
		$event = Event::current()->first();
		if (empty($event)) {
			$event = Event::future()->orderBy('start', 'asc')->first();
			return view('frontpage.empty', [
				'event' => $event
			]);
		}
		$meta = $this->getMeta(NULL);
		return view('frontpage.event', [
			'event' => $event,
			'meta' => $meta
		]);
	}
}
