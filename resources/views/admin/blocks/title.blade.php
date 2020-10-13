@twillBlockTitle('Cím')
@twillBlockIcon('wysiwyg_header')
@twillBlockComponent('a17-block-title')

@formField('input', [
	'name' => 'title',
	'label' => 'Cím',
	'translated' => true,
])

@formField('select', [
	'name' => 'type',
	'options' => [
		[
			'value' => 'title',
			'label' => 'Cím',
		],
		[
			'value' => 'subtitle',
			'label' => 'Alcím',
		],
	],
	'label' => 'Betűméret',
	'default' => 'title'
])