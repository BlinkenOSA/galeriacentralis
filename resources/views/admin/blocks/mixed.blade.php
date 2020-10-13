@twillBlockTitle('Szöveg + kép')
@twillBlockIcon('image-text')
@twillBlockComponent('a17-block-mixed')

@formField('input', [
	'name' => 'title',
	'label' => 'Cím',
	'translated' => true,
])

@formField('wysiwyg', [
	'name' => 'body',
	'label' => 'Szöveges tartalom',
	'toolbarOptions' => [
		['header' => [false,2,3]], 'bold', 'italic', 'underline', 'link', ["align" => []], 'list-ordered', 'list-unordered',
	],
	'translated' => true,
	'type' => 'tiptap',
 ])

@formField('medias', [
	'name' => 'image',
	'label' => 'Kép',
])

@formField('select', [
	'name' => 'orientation',
	'label' => 'Elrendezés',
	'options' => [
		[
			'value' => 'image',
			'label' => 'Kép - szöveg'
		],
		[
			'value' => 'text',
			'label' => 'Szöveg - kép'
		],
	]
])

@formField('input', [
	'name' => 'label',
	'label' => 'Gomb felirat',
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