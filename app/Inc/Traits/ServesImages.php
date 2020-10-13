<?php

namespace App\Inc\Traits;

trait ServesImages
{
	protected $imageSizes = [
		'small' => 400,
		'medium' => 800,
		'medium_large' => 1200,
		'large' => 2400
	];

	public function imageUrl($size='large', $role='image', $crop='default', $media = null)
	{	
		$size = array_key_exists($size, $this->imageSizes) ? $size : 'large';
		$params = [
			'q' => 35,
			'h' => $this->imageSizes[$size],
			'w' => $this->imageSizes[$size]
		];

		return $this->image($role, $crop, $params, false, false, $media);
	}

	public function renderImage($classes='', $size='large', $role='image', $crop='default', $isAsync=null, $media=null)
	{
		if (!$this->hasImage($role)) {
			// return view('partials.imagePlaceholder');
			return;
		}
		$size = array_key_exists($size, $this->imageSizes) ? $size : 'large';
		$isAsync = $isAsync ?? $size != 'small';
		$params = [
			'q' => 35
		];
		$smallParams = array_merge($params, [
			'h' => $this->imageSizes['small'],
			'w' => $this->imageSizes['small'],
		]);
		$fullParams = array_merge($params, [
			'h' => $this->imageSizes[$size],
			'w' => $this->imageSizes[$size],
		]);
		$url = $isAsync ? $this->image($role, $crop, $smallParams, false, false, $media) : $this->image($role, $crop, $fullParams, false, false, $media);
		$asyncAttrib = $isAsync ? "data-src={$this->image($role, $crop, $fullParams, false, false, $media)}" : '';
		$alt = $this->imageAltText($role);
		$classes = $isAsync ? "{$classes} asyncImage" : $classes;

		return view('partials.image', ['classes' => $classes, 'alt' => $alt, 'url' => $url, 'asyncAttrib' => $asyncAttrib]);
	}

}