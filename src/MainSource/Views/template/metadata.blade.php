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

<link rel="stylesheet" type="text/css" href="{{ admin_asset('vendor/pace/pace.css') }}">
<script src="{{ admin_asset('vendor/pace/pace.min.js') }}" type="text/javascript"></script>
<!-- Vendor CSS -->
<link rel="stylesheet" type="text/css" href="{{ admin_asset('css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ admin_asset('fonts/icomoon.css') }}">
<link href="{!! admin_asset('vendor/font-awesome/css/font-awesome.css') !!}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ admin_asset('fonts/flag-icon-css/css/flag-icon.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ admin_asset('css/bootstrap-extended.css') }}">
<link rel="stylesheet" type="text/css" href="{{ admin_asset('css/app.css') }}">
<link rel="stylesheet" type="text/css" href="{{ admin_asset('css/colors.css') }}">
<link rel="stylesheet" type="text/css" href="{{ admin_asset('css/core/menu/menu-types/vertical-menu.css') }}">
<link rel="stylesheet" type="text/css" href="{{ admin_asset('css/core/menu/menu-types/vertical-overlay-menu.css') }}">
<link rel="stylesheet" type="text/css" href="{{ admin_asset('css/core/colors/palette-gradient.css') }}">
<!-- END Vendor CSS-->
<link rel="stylesheet" href="{!! admin_asset('vendor/select2/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! admin_asset('vendor/switchery/css/switchery.min.css') !!}">
<link rel="stylesheet" href="{!! admin_asset('vendor/bootstrap-tag/bootstrap-tagsinput.css') !!}">
<link rel="stylesheet" href="{!! admin_asset('vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') !!}">
<link rel="stylesheet" href="{{ admin_asset('vendor/tinymce/skins/lightgray/skin.min.css') }}">
<link rel="stylesheet" href="{{ admin_asset('vendor/timepicker/jquery.timepicker.min.css') }}">
<link class="main-stylesheet" href="{!! admin_asset('css/additional.css') !!}" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="{{ storage_url(thumbnail(setting('admin.favicon'), 'small')) }}" />
<!-- jquery -->
<script src="{{ admin_asset('js/core/libraries/jquery.min.js') }}" type="text/javascript"></script>

@stack ('style')
@stack ('styles')