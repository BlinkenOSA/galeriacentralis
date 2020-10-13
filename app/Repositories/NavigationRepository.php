<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Navigation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class NavigationRepository extends ModuleRepository
{
	use HandleBlocks, HandleTranslations, HandleSlugs;

	public function __construct(Navigation $model)
	{
		$this->model = $model;
	}

	public function afterSave($object, $fields)
	{
		parent::afterSave($object, $fields);
		$this->cacheNavigation($object);
	}

	public function cacheNavigation($object)
	{
		$navigation = [
			'title' => $object->title,
			'children' => []
		];
		$baseBlocks = $object->blocks->where('parent_id', NULL);
		foreach ($baseBlocks as $baseBlock) {
			$navItem = $this->createBaseBranch($baseBlock);
			$navItem['children'] = $this->getChildrenRecursive($baseBlock);
			$navigation['children'][] = $navItem;
		}
		$slug = count(config('translatable.locales')) > 1 ? $object->slugs->where('locale', 'en')->first()->slug : $object->slugs->first()->slug;
		Cache::store('file')->forever($slug, serialize($navigation));
		return $navigation;
	}

	public function createBaseBranch($block)
	{
		$langs = config('translatable.locales');
		$isTranslatable = count($langs) > 1;
		if ($block->relatedItems->count() > 0 && $block->input('type') == 'browser') {
			$related = $block->relatedItems->first()->related;
			$moduleName = Str::camel($related->getTable());
			$baseBranch = [
				'title' => $isTranslatable ?
					collect($langs)->mapWithKeys(function($lang) use ($block) {
						return [$lang => $block->translatedInput('title', $lang)];
					})->toArray() : $block->translatedInput('title'),
				'url' => $isTranslatable ?
					collect($langs)->mapWithKeys(function($lang) use ($related, $moduleName) {
						$routeParams = ['slug' => $related->slug] + ($lang != config('app.locale') ? ['locale' => $lang] : []);
						return [$lang => route("{$lang}.{$moduleName}.show", $routeParams)];
					})->toArray() : route("{$moduleName}.show", ['slug' => $related->slug]),
				'external' => false
			];
		} else {
			$url = $block->translatedInput('url');	
			$withBase = preg_match('/\./', $url);
			$withProtocol = preg_match('/http/', $url);
			$protocol = preg_match('/https/', $url) ?'https://' : 'http://';
			$prefix = !$withProtocol ? $protocol : '';
			$external = $withBase && !preg_match('/' . config('app.url') . '/', $url);
			$baseBranch = [
				'title' => $isTranslatable ?
					collect($langs)->mapWithKeys(function($lang) use ($block) {
						return [$lang => $block->translatedInput('title', $lang)];
					})->toArray() : $block->translatedInput('title'),
				'url' => $isTranslatable ?
					collect($langs)->mapWithKeys(function($lang) use ($block, $withProtocol, $prefix) {
						return [$lang => $withProtocol ? $prefix . $block->translatedInput('url', $lang) : $block->translatedInput('url', $lang)];
					})->toArray() : ($withBase ? $prefix . $block->input('url') : $prefix . config('app.url') . '/' . $block->translatedInput('url')),
				'external' => $external
			];
		}
		return $baseBranch;
	}

	protected function getChildrenRecursive($block)
	{	
		$children = [];
		foreach ($block->children as $child) {
			$branch = $this->createBaseBranch($child);
			// $branch['children'] = $this->getChildrenRecursive($child);
			$children[] = $branch;
		}
		return $children;
	}

}
