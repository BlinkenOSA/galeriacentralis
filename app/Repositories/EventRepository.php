<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleTags;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Event;

class EventRepository extends ModuleRepository
{
    use HandleTranslations, HandleSlugs, HandleMedias, HandleTags;

	public $browsers = [
		'categories' => [
			'routePrefix' => 'events'
		]
	];

	public $repeaters = [
		'press_items'
	];

    public function __construct(Event $model)
    {
        $this->model = $model;
	}
}
