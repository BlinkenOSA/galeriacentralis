@extends('twill::layouts.form')

@section('contentFields')
	@formField('checkbox', [
		'name' => 'maintenance',
		'label' => 'Maintenance mode'
	])

	@formField('input', [
		'name' => 'instagram',
		'label' => 'Instagram account'
	])

	@formField('input', [
		'name' => 'facebook',
		'label' => 'Facebook account'
	])

	@formField('input', [
		'name' => 'twitter',
		'label' => 'Twitter account'
	])

	@formField('input', [
		'name' => 'youtube',
		'label' => 'Youtube account'
	])

	@formField('input', [
		'name' => 'phone',
		'label' => 'Telephone'
	])

	@formField('input', [
		'name' => 'fax',
		'label' => 'Fax'
	])

	@formField('input', [
		'name' => 'email',
		'label' => 'General information'
	])

	@formField('wysiwyg', [
		'name' => 'hours',
		'label' => 'Opening times',
		'translated' => true,
		'editSource' => true,
		'toolbarOptions' => config('twill.toolbar_options')
	])

	@formField('wysiwyg', [
		'name' => 'address',
		'label' => 'Address',
		'translated' => true,
		'editSource' => true,
		'toolbarOptions' => config('twill.toolbar_options')
	])

	@formField('wysiwyg', [
		'name' => 'programs',
		'label' => 'Public programs',
		'translated' => true,
		'editSource' => true,
		'toolbarOptions' => config('twill.toolbar_options')
	])

	@formField('wysiwyg', [
		'name' => 'about',
		'label' => 'About us',
		'translated' => true,
		'editSource' => true,
		'toolbarOptions' => config('twill.toolbar_options')
	])

	@formField('wysiwyg', [
		'name' => 'impressum',
		'label' => 'Imperssum',
		'translated' => true,
		'editSource' => true,
		'toolbarOptions' => config('twill.toolbar_options')
	])

	@formField('input', [
		'name' => 'metatitle',
		'label' => 'Default meta title',
		'translated' => true
	])

	@formField('input', [
		'type' => 'textarea',
		'name' => 'metadescription',
		'label' => 'Default meta description',
		'translated' => true
	])

	@formField('medias', [
		'name' => 'logo',
		'label' => 'Logo'
	])
@stop
