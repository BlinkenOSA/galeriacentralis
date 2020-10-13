@twillRepeaterTitle('Menüpont')
@twillRepeaterTrigger('Menüpont hozzáadása')
@twillRepeaterComponent('a17-block-nav_subitem')

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
		'note' => 'Belső URL esetén domain nélkül (pl. "/hirek"), egyéb esetben teljes URL (pl. "https://index.hu/belfold")',
		'translated' => true
	])

@endcomponent

@formField('repeater', [
	'type' => 'nav_subsubitem'
])