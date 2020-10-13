@php
	$caption = caption($block) ?? null;
@endphp

<a href="{{ imgUrl($block, 'large') }}" class="content__image-link">
	<figure class="content__figure">
		{!! img($block, 'content__image', 'medium_large') !!}
		@if (!empty($caption))
			<figcaption class="content__caption">{{ $caption }}</figcaption>
		@endif
	</figure>
</a>