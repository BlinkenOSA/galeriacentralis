@twillBlockTitle('Táblázat')
@twillBlockIcon('fix-grid')
@twillBlockComponent('a17-block-table')

@formField('wysiwyg', [
    'type' => 'quill',
	'name' => 'table',
	'label' => 'Táblázat',
	'type' => 'tiptap',
	'translated' => true,
	'toolbarOptions' => [
		'table'
	],
])