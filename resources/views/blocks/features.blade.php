@php
	$features = $block->content;
@endphp

<section class="features">
	<h2 class="features__title">{{ $features['title'] }}</h2>
	@foreach ($block->children as $item)
		@php
			$feature = $item->content;
		@endphp
		<h3 class="features__subtitle">{{ $feature['title'] }}</h3>
	@endforeach
</section>