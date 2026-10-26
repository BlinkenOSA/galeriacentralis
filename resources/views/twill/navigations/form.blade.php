@extends('twill::layouts.form')

@section('contentFields')
	@formField('block_editor', [
		'blocks' => 'nav_item'
	])
@stop

