<?php

return [
	// Keep the existing Twill 2 database and /manage admin URLs.
	'admin_app_path' => env('ADMIN_APP_PATH', 'manage'),
	'default_crops' => [
		'image' => ['default' => [['name' => 'free', 'ratio' => 0]]],
		'logo' => ['default' => [['name' => 'free', 'ratio' => 0]]],
	],
	'blocks_table' => 'blocks',
	'features_table' => 'features',
	'settings_table' => 'settings',
	'medias_table' => 'medias',
	'mediables_table' => 'mediables',
	'files_table' => 'files',
	'fileables_table' => 'fileables',
	'related_table' => 'related',
	'tags_table' => 'tags',
	'tagged_table' => 'tagged',
	'block_editor' => [
		'block_views_path' => 'blocks',
		'default_blocks' => ['images',  'button', 'image', 'mixed', 'text', 'title'],
		'crops' => [
			'image' => [
				'default' => [
					[
						'name' => 'free',
						'ratio' => 0,
					],
				],
			],
			'images' => [
				'default' => [
					[
						'name' => 'free',
						'ratio' => 0,
					],
				],
			],
			'logo' => [
				'default' => [
					[
						'name' => 'free',
						'ratio' => 0,
					],
				],
			],
		],
		'browser_route_prefixes' => [
			'categories' => 'events',
			'events' => 'events'
		],
	],
	'media_library' => [
		'image_sizes' => [
			'small' => 400,
			'medium' => 800,
			'medium_large' => 1200,
			'large' => 2400
		],
		'extra_metadatas_fields' => [
			[
				'name' => 'credit',
				'label' => 'Photo credit',
			],
			[
				'name' => 'frontpage',
				'label' => 'Featured on frontpage',
				'type' => 'checkbox'
			]
		]
	],
	'endpoints' => [
		// [
		// 	'label' => 'Oldalak',
		// 	'value' => '/manage/content/pages/browser',
		// ],
		[
			'label' => 'Events',
			'value' => '/manage/events/events/browser',
		],
		[
			'label' => 'Categories',
			'value' => '/manage/events/categories/browser',
		],
	],
	'toolbarConfig' => [
		'bold', 'italic', 'underline', ["align" => []], 'link', 'list-ordered', 'list-unordered', 'blockquote'
	],
	'toolbar_options' => [
		// ['header' => [2, 3, false]],
		'bold',
		'italic',
		'underline',
		// 'strike',
		// ["script" => "super"],
		// ["script" => "sub"],
		// "blockquote",
		// "code-block",
		['list' => 'ordered'],
		['list' => 'bullet'],
		// ['indent' => '-1'],
		// ['indent' => '+1'],
		["align" => []],
		// ["direction" => "rtl"],
		'link',
		"clean",
	],
];
