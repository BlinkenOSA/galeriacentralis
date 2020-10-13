<ul class="primary__sublist">
	@foreach ($item['children'] as $subItem)
		<li class="primary__subitem">
			<a class="primary__link{{ !empty($subItem['children']) ? ' primary__link--parent' : '' }}" href="{{ !empty($subItem['children']) ? '#' : $subItem['url'] }}"><span>{{ $subItem['title'] }}</span></a>
			@includeWhen(!empty($item['children']), 'partials.submenu', ['item' => $subItem])
		</li>
	@endforeach
</ul>