<?php

namespace App\Inc\Traits;

use Illuminate\Support\Str;

trait HasModuleHelpers
{
	public function getModuleNameAttribute()
	{
		return Str::camel($this->getTable());
	}
}