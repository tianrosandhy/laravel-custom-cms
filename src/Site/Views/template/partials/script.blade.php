<script>
	var BASE_URL = '{{ url('/') }}';
	var CSRF_TOKEN = '{{ csrf_token() }}';
	var CURRENT_URL = '{{ url()->current() }}';
</script>
@if(env('APP_ENV') == 'local')
<script src="{{ asset('assets/js/vendor/jquery-1.12.0.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/jquery.lazy.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/prism.js') }}"></script>
<script src="{{ asset('assets/js/vendor/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/js/additional.js') }}"></script>
<script src="{{ asset('assets/js/site-script.js') }}"></script>
@else
<script src="{{ asset(mix('js/site.js')) }}"></script>
@endif
<!-- Google Analytic & Tag Manager -->
<script>
  window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
  ga('create', 'UA-42132853-3', 'auto');
  ga('require', 'eventTracker');
  ga('require', 'outboundLinkTracker');
  ga('require', 'urlChangeTracker');
  ga('send', 'pageview');

	function gtr($label, $event_name){
		$label = $label || 'Basic Button Click';
		$event_name = $event_name || 'click';
		window.ga('send', 'event', $label, $event_name);
	}
</script>
<script async src="https://www.google-analytics.com/analytics.js?id=UA-42132853-3"></script>
<script src="{{ asset('assets/js/vendor/autotrack.js') }}"></script>
@if(!isset($homepage))
<!-- Google Ads -->
<script defer src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script defer>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-6556906802715782",
          enable_page_level_ads: true
     });
</script>
@endif