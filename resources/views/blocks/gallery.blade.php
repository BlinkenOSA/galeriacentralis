@php
	$gallery = $block->imageObjects('images', 'default');
@endphp

<section class="gallery content__gallery">
	<figure class="gallery__inner">
		@foreach ($gallery as $item)
			<a class="gallery__link" href="{{ imgUrl($block, 'large', 'images', 'default', $item) }}">
				{!! img($block, 'gallery__image', 'small', 'images', 'default', null, $item) !!}
			</a>
		@endforeach
	</figure>
</section>