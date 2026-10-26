<?php

return [
	'events' => [
		'title' => 'Events',
		'route' => 'twill.events.events.index',
		'primary_navigation' => [
			'events' => [
				'title' => 'Events',
				'module' => true,
			],
			'categories' => [
				'title' => 'Categories',
				'module' => true,
			],
		],
	],
	// 'content' => [
	// 	'title' => 'Pages',
	// 	'route' => 'twill.content.pages.index',
	// ],
	// 'navigation' => [
	// 	'title' => 'Navigáció',
	// 	'route' => 'twill.navigations.index',
	// ],
	'options' => [
		'title' => 'Options',
		'route' => 'twill.options.show',
		'params' => ['option' => 1]
	],
];
