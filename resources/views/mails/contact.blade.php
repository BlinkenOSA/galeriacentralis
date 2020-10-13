@extends('mails.base')

@section('title')
	Új üzenet
@endsection

@section('preheader')
	Új üzenet a weboldal formról!
@endsection

@section('greeting')
	Új üzenet érkezett a weboldal formról:
@endsection

@section('message')
	<p>Név: {{ $contact['name'] }}</p>
	<p>E-mail: {{ $contact['email'] }}</p>
	<p>Tárgy: {{ $contact['subject'] }}</p>
	<p>Üzenet: {{ $contact['message'] }}</p>
@endsection