<!-- Default meta tags -->
<?php
if(!isset($mainTitle)){
	$mainTitle = setting('site.title');
}
if(!isset($mainDescription)){
	$mainDescription = setting('site.subtitle');
}

//prepare SEO variables
$list = [
	'name',
	'description',
	'keywords',
];

foreach ($list as $nm){
	if(!isset($seo[$nm])){
		if(isset($forceSEO)){
			$seo[$nm] = setting('seo.'.$nm);
		}
	}
}

if(!isset($seo['image'])){
	$seo['image'] = setting('seo.image');
}
if(strlen($seo['image']) == 0){
	$seo['image'] = setting('seo.image');
}

//check if is file image
if(is_file(Storage::path($seo['image']))){
	list($dwidth, $dheight) = getimagesize(Storage::path($seo['image']));
	$seo['dimension']['width'] = $dwidth;
	$seo['dimension']['height'] = $dheight;
}
?>
@if(isset($seo['description']))
<meta name="description" content="{!! $seo['description'] !!}"/>
@endif
@if(isset($seo['keyword']))
<meta name="keywords" content="{!! $seo['keyword'] !!}"/>
@endif
@if(isset($seo['name']))
<meta name="copyright" content="{{ $seo['name'] }}">
<meta name="author" content="{{ $seo['name'] }}"/>
<meta name="application-name" content="{{ $seo['name'] }}">
<!--Facebook Tags-->
<meta property="og:site_name" content="{{ $seo['name'] }}">
@endif
<meta property="og:url" content="{{ request()->fullUrl() }}"/>
<meta property="og:title" content="{{ isset($seo['title']) ? $seo['title'].' - '.$mainTitle : $mainTitle . '-' . $mainDescription }}"/>
@if(isset($seo['description']))
<meta property="og:description" content="{!! $seo['description'] !!}"/>
@endif
@if(isset($seo['image']))
<meta property="og:image" content="{!! $seo['image'] !!}"/>
@endif
@if(isset($seo['dimension']['width']))
<meta property="og:image:width" content="{!! $seo['dimension']['width'] !!}">
@endif
@if(isset($seo['dimension']['height']))
<meta property="og:image:height" content="{!! $seo['dimension']['height'] !!}">
@endif
<meta property="og:locale" content="id_ID"/>
<meta property="og:type" content="website">
<meta property="fb:app_id" content="{{ setting('api.fb_app') }}">
<!--Twitter Tags-->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:title" content="{{ isset($seo['title']) ? $seo['title'].' - '.$mainTitle : $mainTitle . ' - ' . $mainDescription }}"/>
@if(isset($seo['description']))
<meta name="twitter:description" content="{!! $seo['description'] !!}"/>
@endif
@if(isset($seo['image']))
<meta name="twitter:image" content="{{ Storage::url($seo['image']) }}"/>
@endif