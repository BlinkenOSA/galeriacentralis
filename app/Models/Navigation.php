<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Model;

class Navigation extends Model
{
	use HasBlocks, HasTranslation, HasSlug;

	protected $fillable = [
		'title',
		'published',
	];
	
	public $translatedAttributes = [
		'title',
		'active',
	];
	
	public $slugAttributes = [
		'title',
	];
}
