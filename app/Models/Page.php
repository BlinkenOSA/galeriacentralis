<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use App\Inc\Traits\HasModuleHelpers;
use App\Inc\Traits\ServesImages;
use A17\Twill\Models\Model;

class Page extends Model 
{
	use HasBlocks, HasTranslation, HasSlug, HasMedias, HasModuleHelpers, ServesImages;

	protected $fillable = [
		'published',
		'title',
		'description',
	];
	
	public $translatedAttributes = [
		'title',
		'description',
		'active',
	];
	
	public $slugAttributes = [
		'title',
	];
}
