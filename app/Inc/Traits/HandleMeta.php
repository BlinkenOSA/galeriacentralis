<?php

namespace App\Inc\Traits;

use A17\Twill\Models\Media;
use App\Models\Option;
use Illuminate\Database\Eloquent\Builder;

trait HandleMeta
{
	public function getMeta($object)
	{
		$options = Option::first();
		$logo = $options->imageObject('logo');
		$seo = [
			'title' => !empty($object->title) ? $object->title : config('meta.title'),
			'description' => !empty($object->description) ? $object->description : $options->fields['description'][app()->getLocale()],
			'image' => !empty($image) ? asset('img/' . $image['uuid'] . '?w=1200&q=25') : asset('img/' . $logo['uuid'] . '?w=1200&q=25')
		];
		return $seo;
	}
}