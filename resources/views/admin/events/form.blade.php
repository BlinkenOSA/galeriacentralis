@extends('twill::layouts.form')


@section('contentFields')
	@formField('input', [
		'name' => 'subtitle',
		'label' => 'Subtitle',
		'translated' => true
	])

    @formField('input', [
        'name' => 'description',
        'label' => 'Description',
		'translated' => true,
		'type' => 'textarea'
	])
	
	@formField('wysiwyg', [
        'name' => 'summary',
        'label' => 'Summary',
		'translated' => true,
		'editSource' => true,
		'toolbarOptions' => config('twill.toolbar_options')
	])
	
	@formField('input', [
		'name' => 'genre',
		'label' => 'Genre',
		'translated' => true
	])

	@formField('input', [
        'name' => 'curator',
        'label' => 'Curated By',
	])

	@formField('wysiwyg', [
		'name' => 'artists',
		'label' => 'Artists',
		'editSource' => true,
		'toolbarOptions' => config('twill.toolbar_options')
	])

	@formField('wysiwyg', [
		'name' => 'coop',
		'label' => 'In cooperation with',
		'editSource' => true,
		'toolbarOptions' => config('twill.toolbar_options')
	])

	@formField('wysiwyg', [
		'name' => 'partners',
		'label' => 'Partners',
		'editSource' => true,
		'toolbarOptions' => config('twill.toolbar_options')
	])

	{{-- @formField('wysiwyg', [
		'name' => 'press',
		'label' => 'Press',
		'editSource' => true,
		'toolbarOptions' => config('twill.toolbar_options')
	]) --}}
	<label class="input__label" style="margin-top: 35px; display: block;">Press</label>
	@formField('repeater', [
		'type' => 'press_items'
	])

	@formField('medias', [
		'name' => 'images',
		'label' => 'Gallery',
		'max' => 12
	])
@stop

@section('sideFieldsets')

	<a17-fieldset title="Tulajdonságok">
		@formField('date_picker', [
			'name' => 'start',
			'label' => 'Start date',
			'time24Hr' => true,
			'withTime' => false
		])

		@formField('input', [
			'name' => 'start_time',
			'label' => 'Start time',
			'type' => 'time'
		])

		@formField('date_picker', [
			'name' => 'end',
			'label' => 'End date',
			'time24Hr' => true,
			'withTime' => false
		])
		
		@formField('input', [
			'name' => 'end_time',
			'label' => 'End time',
			'type' => 'time'
		])

		@formField('browser', [
			'label' => 'Category',
			'max' => 1,
			'name' => 'categories',
			'moduleName' => 'categories',
		])

		@formField('tags', [
			'label' => 'Tags'
		])

		@formField('color', [
			'name' => 'color',
			'label' => 'Main color'
		])

		@formField('checkbox', [
			'name' => 'series',
			'label' => 'Is series'
		])

		@formField('checkbox', [
			'name' => 'virtual',
			'label' => 'Is virtual'
		])

		@formField('checkbox', [
			'name' => 'monoscope',
			'label' => 'Is monoscope'
		])
	</a17-fieldset>

@stop