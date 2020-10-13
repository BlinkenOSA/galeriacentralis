@twillBlockTitle('Szöveg')
@twillBlockIcon('text')
@twillBlockComponent('a17-block-text')

@formField('wysiwyg', [
	'name' => 'body',
	'label' => 'Szöveges tartalom',
	'toolbarOptions' => config('twill.toolbarConfig'),
	'translated' => true,
	'type' => 'tiptap',
])

@formField('checkbox', [
	'name' => 'framed',
	'label' => 'Keretes'
])