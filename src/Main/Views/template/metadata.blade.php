<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>
	@include ('main::template.components.title')
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta content="tianrosandhy" name="author" />
<link href="{!! admin_asset('assets/plugins/pace/pace-theme-flash.css') !!}" rel="stylesheet" type="text/css" />
@if(setting('admin.theme') != 'klorofil')
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
	@if(!config('cms.admin.minified'))
	<link href="{!! admin_asset('assets/plugins/bootstrapv3/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! admin_asset('assets/plugins/font-awesome/css/font-awesome.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! admin_asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css') !!}" rel="stylesheet" type="text/css" media="screen" />
	<link href="{!! admin_asset('assets/plugins/select2/css/select2.min.css') !!}" rel="stylesheet" type="text/css" media="screen" />
	<link href="{!! admin_asset('assets/plugins/switchery/css/switchery.min.css') !!}" rel="stylesheet" type="text/css" media="screen" />
	<link href="{!! admin_asset('pages/css/pages-icons.css') !!}" rel="stylesheet" type="text/css">
	<link class="main-stylesheet" href="{!! admin_asset('pages/css/pages.css') !!}" rel="stylesheet" type="text/css" />
	@else
	<link rel="stylesheet" href="{!! asset('maxsol/css/backend.css') !!}">
	@endif
@elseif(setting('admin.theme') == 'klorofil')
	@if(!config('cms.admin.minified'))
	<link rel="stylesheet" href="{!! admin_asset('assets/plugins/bootstrapv3/css/bootstrap.min.css') !!}">
	<link rel="stylesheet" href="{!! admin_asset('assets/plugins/font-awesome/css/font-awesome.css') !!}">
	<link rel="stylesheet" href="{!! admin_asset('assets/plugins/select2/css/select2.min.css') !!}">
	<link rel="stylesheet" href="{!! admin_asset('assets/plugins/switchery/css/switchery.min.css') !!}">
	<link rel="stylesheet" href="{!! admin_asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css') !!}">
	<link rel="stylesheet" href="{!! admin_asset('assets/plugins/bootstrap-datepicker/css/datepicker.css') !!}">
	<link rel="stylesheet" href="{{ admin_asset('klorofil/assets/vendor/linearicons/style.css') }}">
	<link rel="stylesheet" href="{!! admin_asset('klorofil/assets/css/main.css') !!}">

	@else
	<link rel="stylesheet" href="{{ asset('maxsol/css/backend-klorofil.css') }}">
	@endif
@endif
<link rel="stylesheet" href="{{ admin_asset('assets/plugins/tinymce/skins/lightgray/skin.min.css') }}">
<link rel="stylesheet" href="{{ admin_asset('assets/plugins/timepicker/jquery.timepicker.min.css') }}">
<link class="main-stylesheet" href="{!! admin_asset('assets/css/style.css') !!}" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="{{ Storage::url(thumbnail(setting('admin.favicon'), 'small')) }}" />
@stack ('style')
@stack ('styles')