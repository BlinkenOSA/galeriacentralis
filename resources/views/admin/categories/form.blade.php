@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
        'name' => 'description',
        'label' => 'Kategória leírása',
        'translated' => true,
		'maxlength' => 160,
		'type' => 'textarea'
    ])
@stop

@section('sideFieldsets')

	<a17-fieldset title="Tulajdonságok">
		@formField('medias', [
			'name' => 'image',
			'label' => 'Kiemelt kép',
		])
	</a17-fieldset>

@stop
