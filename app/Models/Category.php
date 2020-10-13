<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;

class Category extends Model implements Sortable
{
	use HasTranslation, HasSlug, HasMedias, HasPosition;

	protected $fillable = [
		'published',
		'title',
		'description',
		'position',
	];
	
	public $translatedAttributes = [
		'title',
		'description',
		'active',
	];
	
	public $slugAttributes = [
		'title',
	];

	public function events()
	{
		return $this->belongsToMany('App\Models\Event');
	}
}
