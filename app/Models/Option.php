<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRelated;
use A17\Twill\Models\Model;

class Option extends Model 
{
	use HasTranslation, HasSlug, HasMedias, HasRelated;

	protected $fillable = [
		'published',
		'title',
		'options'
	];
	
	public $translatedAttributes = [
		'title',
		'active',
	];
	
	public $slugAttributes = [
		'title',
	];

	public function getFieldsAttribute()
	{
		return json_decode($this->options, true);
	}
}
