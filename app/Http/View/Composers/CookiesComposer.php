<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class CookiesComposer
{
	protected $cookies;

	public function __construct(Request $request)
	{
		$this->cookies = [
			'accepted' => $request->cookie('accepted')
		];
	}

	public function compose(View $view)
	{
		$view->with([
			'cookies' => $this->cookies
		]);
	}
}