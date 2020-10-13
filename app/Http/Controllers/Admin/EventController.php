<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class EventController extends ModuleController
{
	protected $moduleName = 'events';
	protected $disableEditor = true;
	protected $indexOptions = [
		'skipCreateModal' => true
	];
}
