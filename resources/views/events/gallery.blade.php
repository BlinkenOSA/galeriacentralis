@php
	$template = $template ?? null;
	$gallery = $template == 'frontpage' ? $event->imageObjects('images')->filter(function($image) {
		return $image->frontpage == 1;
	}) : $event->imageObjects('images');
@endphp
<div class="gallery{{ isset($template) ? " gallery--{$template}" : '' }}">
	<div class="gallery__items gallery__items--early">
		@foreach ($gallery as $image)
			<figure class="gallery__figure">
				{!! $event->renderImage('gallery__image', 'medium_large', 'images', 'default', false, $image) !!}
				@if ((!empty($event->imageCaption('images', $image)) || !empty($image->credit)) && $template != 'frontpage')
					<figcaption class="gallery__caption">
						{{ !empty($event->imageCaption('images', $image)) ? $event->imageCaption('images', $image) : '' }}
						{!! !empty($image->credit) && !empty($event->imageCaption('images', $image)) ? "<br/> " : '' !!}
						@if (!empty($image->credit))
							<span class="gallery__credit">
							&#8211; {{ $image->credit }}</span>
						@endif
					</figcaption>
				@endif
			</figure>
		@endforeach
	</div>
	<div class="gallery__nav">
		@foreach ($gallery as $image)
			<div class="gallery__nav-item{{ $loop->first ? ' gallery__nav-item--active' : '' }}"></div>
		@endforeach
	</div>
	<div class="gallery__meta">{{ $event->imageCaption('images') }}
	@if (!empty($gallery->first()->credit))
		<br>
		<span class="gallery__credit">
		&#8211; {{ $gallery->first()->credit }}</span>
	@endif
	{{-- {!! !empty($gallery->first()->credit) ? "<br/>- 
	{$gallery->first()->credit}" : '' !!}</div> --}}
	</div>
</div>