@twillBlockTitle('Főmenüpont')
@twillBlockIcon('media-list')
@twillBlockComponent('a17-block-nav_item')

@formField('input', [
	'name' => 'title',
	'label' => 'Cím',
	'translated' => true
])

@formField('select', [
	'name' => 'type',
	'label' => 'Cél megadása',
	'unpack' => true,
	'options' => [
		[
			'value' => 'browser',
			'label' => 'Listából'
		],
		[
			'value' => 'url',
			'label' => 'URL megadása kézzel'
		],
	]
])

@component('twill::partials.form.utils._connected_fields', [
	'fieldName' => 'type',
	'fieldValues' => 'browser',
	'keepAlive' => true,
	'renderForBlocks' => true
])

	@formField('browser', [
		'endpoints' => config('twill.endpoints'),
		'name' => 'navigationable',
		'label' => 'Cél'
	])
	
@endcomponent

@component('twill::partials.form.utils._connected_fields', [
	'fieldName' => 'type',
	'fieldValues' => 'url',
	'keepAlive' => true,
	'renderForBlocks' => true
])

	@formField('input', [
		'name' => 'url',
		'label' => 'URL',
		'translated' => true
	])

@endcomponent

@formField('repeater', [
	'type' => 'nav_subitem'
])