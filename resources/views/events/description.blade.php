@php
	$template = $template ?? null;
@endphp

<div class="description">
	@if ($template == 'frontpage')
		<div class="description__bg"></div>
	@endif
	<div class="description__container{{ isset($template) ? " description__container--{$template}" : '' }}">
		{{ $event->description }}
	</div>
</div>