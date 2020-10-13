@php
	$policy = '<a href="' . url('adatvedelem') . '">Adatvédelmi tájékoztató</a>';
	$visible = !request()->cookie('accepted');
@endphp

<div class="cookie{{ $visible ? ' cookie--visible' : '' }}">
	<div class="cookie__modal">
		<div class="cookie__container">
			<div class="cookie__text">
				<p>{{ __('Az oldal cookie-kat használ. Az oldal további böngészésével Ön elfogadja a cookie-k használatát.') }}</p>
				<p>{!! sprintf(__(' Bővebb információkért tájékozódjon az %s segítségével!'), $policy) !!}</p>
			</div>
			
			<button class="cookie__button">{{ __('Rendben') }}</button>
		</div>
	</div>
</div>