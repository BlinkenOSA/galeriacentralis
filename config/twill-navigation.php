<?php

return [
	'events' => [
		'title' => 'Events',
		'route' => 'admin.events.events.index',
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
	// 	'route' => 'admin.content.pages.index',
	// ],
	// 'navigation' => [
	// 	'title' => 'Navigáció',
	// 	'route' => 'admin.navigations.index',
	// ],
	'options' => [
		'title' => 'Options',
		'route' => 'admin.options.show',
		'params' => ['option' => 1]
	],
];
