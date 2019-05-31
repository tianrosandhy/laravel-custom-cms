@push ('style')
<style>
	.language-switcher{
		position:fixed;
		top:100px;
		right:0;
		text-align:right;
		padding:.5em;
		z-index:999;
	}
	.language-switcher span{
		font-size:75%;
		display:block;
	}
</style>
@endpush

@if(method_exists($model, 'scopeGetTranslate'))
<div class="padd pull-right">
	<div class="language-switcher">
		<span class="text-uppercase">Manage Language</span>
		@foreach(config('cms.lang.available') as $lang)
		<a href="#" data-lang="{{ $lang }}" class="btn btn-info {{ isset($reload) ? ($reload ? 'btn-lang-switcher reload' : 'btn-lang-static') : 'btn-lang-static' }} {!! $lang == def_lang() ? 'active' : '' !!}">{{ strtoupper($lang) }}</a>
		@endforeach
	</div>
	<div style="clear:both"></div>
</div>

@push ('script')
<script>
$(function(){
	$("body").on('click', '.btn-lang-static', function(e){
		e.preventDefault();
		if($(this).hasClass('active')){
			return;
		}
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