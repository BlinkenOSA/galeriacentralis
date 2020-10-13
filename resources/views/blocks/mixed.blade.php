@php
	$caption = caption($block) ?? null;
	$classes = array_merge(['content__mixed', 'mixed'], ($block->input('reverse') ? ['mixed--reverse'] : []));
@endphp

<div class="{{ implode(' ', $classes) }}">
	<div class="mixed__cleared">
		<a href="{{ imgUrl($block, 'large') }}" class="mixed__image-link">
			<figure class="mixed__figure">
				{!! img($block, 'mixed__image', 'medium_large') !!}
				@if (!empty($caption))
					<figcaption class="content__caption">{{ $caption }}</figcaption>
				@endif
			</figure>
		</a>
		<div class="mixed__text">{!! $block->translatedInput('body') !!}</div>
	</div>
	<div class="mixed__clear"></div>
</div>
