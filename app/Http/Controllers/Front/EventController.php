<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Slugs\EventSlug;
use App\Inc\Traits\HandleMeta;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
	use HandleMeta;

	public function show($category, $slug, Request $request)
	{
		$locale = app()->getLocale();

		$event = Event::forSlug($slug);

		if (Auth::guard('twill_users')->check() == false) {
			$event = $event->publishedInListings();
		}

		if ($category == 'series') {
			$event = $event->series()->first();
		} else {
			$event = $event->whereHas('categories.slugs', function($query) use ($category) {
				$query->where('slug', '=', $category);
			})->first();
		}

		if (empty($event)) {
			// return redirect()->route($locale . '.frontpage');
			abort(404);
		}

		$tags = $event->tags->pluck('slug')->toArray();
		$related = Event::standard()->withTag(implode(', ', $tags))->get()->groupBy(function($item) {
			return $item->categories->first()->slug;
		});

		$series = $event->series ? collect([]) : Event::series()->withActiveTranslations()->withTag(implode(', ', $tags))->get();
		return view('events.show', [
			'event' => $event,
			'meta' => $this->getMeta($event),
			'related' => $related,
			'series' => $series,
			'meta' => $this->getMeta($event)
		]);
	}

	public function index($category, Request $request)
	{

		$events = Event::withActiveTranslations()->standard()->with(['slugs'])->whereHas('categories.slugs', function($query) use ($category) {
			$query->where('slug', '=', $category);
		})->orderBy('start', 'desc');
		if (Auth::guard('twill_users')->check() == false) {
			$events = $events->publishedInListings();
		}

		switch ($request->query('filter')) {
			case __('strings.virtual_slug'):
				$events = $events->virtual();
				break;
			case __('strings.past_slug'):
				$events = $events->past();
				break;
			case __('strings.future_slug'):
				$events = $events->future();
				break;
			case __('strings.present_slug'):
				$events = $events->current();
				break;
			default:
				$events = $events->physical();
				break;
		}

		$meta = $this->getMeta(null);
		$meta['title'] = Category::forSlug($category)->first()->title;
		$events = $events->get()->groupBy(function($item) {
			return $item->start->year;
		})->sortKeysDesc()->all();
		return view('events.index', [
			'events' => $events,
			'meta' => $meta
		]);
	}

	public function search(Request $request)
	{
		if (empty($request->query('s'))) {
			return redirect()->route(app()->getLocale() . '.frontpage');
		}
		$s = $request->query('s');
		$meta = $this->getMeta(null);
		$meta['title'] = "Keresési eredmények - {$s}";
		$results = collect([]);
		if (strlen($s) < 3) {
			$title = __('strings.search_length');
		} else {
			$title = $s;
			$results = Event::publishedInListings()
				->where('curator', 'like', '%' . $s . '%')
				->orWhere('artists', 'like', '%' . $s . '%')
				->orWhere('coop', 'like', '%' . $s . '%')
				->orWhere('partners', 'like', '%' . $s . '%')
				->orWhere('press', 'like', '%' . $s . '%')
				->orWhereHas('translations', function($query) use ($s) {
					$query->where('title', 'like', '%' . $s . '%')
					->orWhere('description', 'like', '%' . $s . '%')
					->orWhere('summary', 'like', '%' . $s . '%')
					->orWhere('genre', 'like', '%' . $s . '%')
					->orWhere('subtitle', 'like', '%' . $s . '%')
					;
				})
				->orWhereHas('tags', function($query) use ($s) {
					$query->where('name', 'like',  '%' . $s . '%');
				})
				->get();
		}
		return view('events.search', [
			'results' => $results,
			'title' => $title,
			'meta' => $meta,
		]);
	}

}
