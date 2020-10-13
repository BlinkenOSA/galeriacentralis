<article class="press-item">
	<h4 class="press-item__title">
		@if (!empty($item->url))
			<a href="{{ $item->url }}" class="press-item__link" target="_blank">{{ $item->title }}</a>
		@else
			{{ $item->title }}
		@endif
	</h4>
	<h5 class="press-item__subtitle">{{ $item->publication }} &#8211; {{ $item->date->isoformat('LL') }}</h5>
	@if ($item->files->count() > 0)
		<a href="{{ $item->file('attachment') }}" class="press-item__file" target="_blank">PDF</a>
	@endif
</article>