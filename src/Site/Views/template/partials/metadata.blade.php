<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>{{ isset($title) ? $title .' - ' : '' }} {{ setting('site.title') }} {{ setting('site.subtitle') }}</title>
<meta name="theme-color" content="#1572AF">
<meta name="robots" content="noindex, follow" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@include ('site::template.partials._favicon')
@if(env('APP_ENV') == 'local')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/used-style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/additional.css') }}">
@else
<link rel="stylesheet" href="{{ asset(mix('css/site.css')) }}">
@endif
<script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
@include ('site::template.partials._seo')