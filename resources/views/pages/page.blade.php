@extends('layouts.full')

@section('content')
	<section class="page">
		{!! $page->renderBlocks() !!}
	</section>
@endsection