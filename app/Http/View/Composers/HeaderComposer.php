<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Option;
use App\Models\Category;
use Illuminate\Support\Str;

class HeaderComposer
{
	protected $categories;
	protected $options;
	// protected $lang;
	protected $urls;

	public function __construct()
	{
		$this->categories = Category::all();
		$this->options = Option::first();
		// $this->lang = app()->getLocale();
		$this->urls = [
			'pressUrl' => Str::slug(__('strings.press')),
			'infoUrl' => Str::slug(__('strings.info')),
		];
	}

	public function compose(View $view)
	{
		$view->with([
			'options' => $this->options,
			'categories' => $this->categories,
			// 'lang' => $this->lang,
			'urls' => $this->urls
		]);
	}
}