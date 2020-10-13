@if ($block->input('title') == 'title')
	<h2 class="content__title">{{ $block->translatedInput('title') }}</h2>
@elseif ($title['type'] == 'subtitle')
	<h3 class="content__subtitle">{{ $block->translatedInput('title') }}</h3>
@endif