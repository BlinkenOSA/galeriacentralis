@extends('layouts.empty')

@section('content')
	<div class="scope">
		@include('scope.404-mobile')
		@include('scope.404-left')
		@include('scope.404-mid')
		@include('scope.404-right')
	</div>
@endsection