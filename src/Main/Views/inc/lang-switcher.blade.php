@if(method_exists($model, 'scopeGetTranslate'))
<div class="padd">
	<div class="language-switcher pull-left">
	@foreach(config('cms.lang.available') as $lang)
		<a href="#" data-lang="{{ $lang }}" class="btn btn-sm btn-info {{ isset($reload) ? ($reload ? 'btn-lang-switcher reload' : 'btn-lang-static') : 'btn-lang-static' }} {!! $lang == def_lang() ? 'active' : '' !!}">{{ strtoupper($lang) }}</a>
	@endforeach
	</div>
	<div style="clear:both"></div>
</div>

@push ('script')
<script>
$(function(){
	$("body").on('click', '.btn-lang-static', function(){
		$(".btn-lang-static").removeClass('active');
		$(this).addClass('active');
		lang = $(this).attr('data-lang');


		$("form .input-language").slideUp();
		$("form .input-language[data-lang='"+lang+"']").slideDown();
	});
});
</script>
@endpush
@endif