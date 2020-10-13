<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class CategoryController extends ModuleController
{
	protected $moduleName = 'categories';
	protected $disableEditor = true;
	protected $indexOptions = [
		'editInModal' => true,
		'reorder' => true
	];
	
}
