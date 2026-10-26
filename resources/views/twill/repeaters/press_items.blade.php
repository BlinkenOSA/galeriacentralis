@twillRepeaterTitle('Press item')
@twillRepeaterTrigger('Add press item')
@twillRepeaterComponent('a17-block-press_items')

@formField('input', [
	'name' => 'title',
	'label' => 'Title of post'
])

@formField('input', [
	'name' => 'url',
	'label' => 'URL of post'
])

@formField('input', [
	'name' => 'publication',
	'label' => 'Title of publication'
])

@formField('date_picker', [
	'name' => 'date',
	'label' => 'Date of publication',
	'withTime' => false
])

@formField('files', [
	'name' => 'attachment',
	'label' => 'Attachment',
	'noTranslate' => true,
])