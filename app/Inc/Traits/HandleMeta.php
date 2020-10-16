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
		$image = isset($object) ? $object->imageObject('image') : NULL;
		$seo = [
			'title' => !empty($object->title) ? $object->title : ($options->fields['metatitle'][app()->getLocale()] ?? ''),
			'description' => !empty($object->description) ? $object->description : ($options->fields['metadescription'][app()->getLocale()] ?? ''),
			'image' => !empty($image) ? asset('img/' . $image['uuid'] . '?w=1200&q=25') : asset('img/' . $logo['uuid'] . '?w=1200&q=25')
		];
		return $seo;
	}
}