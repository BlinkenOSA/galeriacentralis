<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Slugs\PageSlug;
use App\Inc\Traits\HandleMeta;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PressItem;
use App\Models\Event;

class PageController extends Controller
{
	use HandleMeta;

	public function info(Request $request)
	{
		$meta = $this->getMeta(null);
		$meta['title'] = 'Info';
		return view('pages.info', [
			'meta' => $meta
		]);
	}

	public function press(Request $request)
	{
		$events = Event::has('pressItems')->with('pressItems')->orderBy('start')->get();
		$meta = $this->getMeta(null);
		$meta['title'] = __('strings.press');
		return view('pages.press', [
			'meta' => $meta,
			'events' => $events
		]);
	}

	public function show($slug)
	{
		$locale = app()->getLocale();
		$page = Page::forSlug($slug)->first();

		if (empty($page)) {
			abort(404);
		}

		$globalSlug = PageSlug::where('page_id', $page->id)->where('locale', 'en')->first()->slug;
		
		return view()->first(['pages.page-' . $globalSlug, 'pages.page'], [
			'page' => $page,
			'meta' => $this->getMeta($page)
		]);
	}
}
