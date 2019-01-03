@if(!request()->ajax())
<!DOCTYPE html>
<html lang="en">
<head>
	@include ('site::template.partials.metadata')
	@stack ('style')
	@stack ('styles')
</head>
<body class="wrapper">
<div class="inner">
@else
	<span class="ajax-meta" id="meta-data-title">{{ isset($title) ? $title .' - ' : '' }} {{ setting('site.title') }} {{ setting('site.subtitle') }}</span>
@endif
	@include ('site::template.partials.header')
	@yield ('content')	
	@include ('site::template.partials.footer')

@if(!request()->ajax())
</div>
<div id="site-loader" class="site-loader">
	<div class="site-loader-inner">
		<i class="fa fa-spinner fa-spin fa-lg"></i>
	</div>
</div>
@include ('site::template.partials.script')
@stack ('scripts')
@stack ('script')
</body>
</html>
@endif