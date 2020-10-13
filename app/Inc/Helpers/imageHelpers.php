<?php

use A17\Twill\Models\Media;

if (!function_exists('staticImgUrl')) {
	function staticImgUrl($resource, $role='image')
	{
		$uuid = $resource->imageObject($role)->uuid;
		return asset('storage/uploads/' . $uuid);
	}
}

if (!function_exists('img')) {
	function img($resource, $classes='', $size='large', $role='image', $crop='default', $isAsync=null, $media=null)
	{
		if (!$resource->hasImage($role)) {
			return view('partials.imagePlaceholder');
		}
		$sizes = config('twill.media_library.image_sizes');
		$size = array_key_exists($size, $sizes) ? $size : 'large';
		$isAsync = $isAsync ?? $size != 'small';
		$params = [
			'q' => 35
		];
		$smallParams = array_merge($params, [
			'h' => $sizes['small'],
			'w' => $sizes['small'],
		]);
		$fullParams = array_merge($params, [
			'h' => $sizes[$size],
			'w' => $sizes[$size],
		]);
		$url = $isAsync ? $resource->image($role, $crop, $smallParams, false, false, $media) : $resource->image($role, $crop, $fullParams, false, false, $media);
		$asyncAttrib = $isAsync ? "data-src={$resource->image($role, $crop, $fullParams, false, false, $media)}" : '';
		$alt = $resource->imageAltText($role);
		$classes = $isAsync ? "{$classes} asyncImage" : $classes;
		return view('partials.image', ['classes' => $classes, 'alt' => $alt, 'url' => $url, 'asyncAttrib' => $asyncAttrib]);
	}
}

if (!function_exists('imgUrl')) {
	function imgUrl($resource, $size='large', $role='image', $crop='default', $media=null)
	{
		$sizes = config('twill.media_library.image_sizes');
		$size = array_key_exists($size, $sizes) ? $size : 'large';
		$params = [
			'q' => 35,
			'h' => $sizes[$size],
			'w' => $sizes[$size]
		];
		return $resource->image($role, $crop, $params, false, false, $media);
	}
}

if(!function_exists('alt')) {
	function alt($resource, $role = 'image')
	{
		if ($resource instanceof Media) {
			return $resource->getMetadata('altText', 'alt_text');
		} else {
			return $resource->imageAltText($role);
		}
	}
}

if(!function_exists('caption')) {
	function caption($resource, $role = 'image')
	{
		if ($resource instanceof Media) {
			return $resource->getMetadata('caption') ?? '';
		} else {
			return $resource->imageCaption($role);
		}
	}
}

if(!function_exists('images')) {
	function images($resource, $role = 'images', $crop = 'default')
	{
		return $resource->imageObjects($role, $crop);
	}
}