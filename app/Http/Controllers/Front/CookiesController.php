<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CookiesController extends Controller
{

	public function accept(Request $request)
	{
		if (!$request->cookie('accepted')) {
			return response('OK', 200)->cookie('accepted', true, 525600);
		}
	}
}
