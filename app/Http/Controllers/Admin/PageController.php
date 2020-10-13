<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class PageController extends ModuleController
{
	protected $moduleName = 'pages';
	protected $disableEditor = true;
	protected $permalinkBase = '';
	protected $indexOptions = [
		'skipCreateModal' => true
	];
}
