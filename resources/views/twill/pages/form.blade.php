@extends('twill::layouts.form')

@section('contentFields')
	@formField('input', [
		'name' => 'description',
		'label' => 'Oldal leírása',
		'type' => 'textarea',
		'maxlength' => 160,
		'translated' => true,
	])

	@formField('block_editor')
@stop

@section('sideFieldsets')

	<a17-fieldset title="Tulajdonságok">
		@formField('medias', [
			'name' => 'image',
			'label' => 'Kiemelt kép',
		])
	</a17-fieldset>

@stop