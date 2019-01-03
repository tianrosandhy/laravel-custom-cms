@extends ('main::master')

@push ('style')
<style>
	table th{
		white-space:nowrap;
		padding-right:1.75em!important;
		cursor:pointer;
	}

	.ov{
		overflow-x:scroll!important;
	}
</style>
@endpush

@section ('content')
<h3>{!! $title !!}</h3>

@include ('main::inc.lang-switcher', [
	'model' => $datatable->model,
	'reload' => true
])

<div class="padd">
	@if(Route::has('admin.'.$hint.'.grab'))
	<div class="pull-left">
		<a href="{{ url()->route('admin.'.$hint.'.grab') }}" class="btn btn-primary">Grab from Instagram</a>
	</div>
	@endif

	<div class="clearfix"></div>
</div>




<div class="panel">
	<div class="panel-body ov">
		{!! $datatable->view() !!}
	</div>
</div>

@stop

@push ('script')
	@include ('main::assets.datatable', [
		'url' => url()->route('admin.'.$hint.'.datatable')
	])
@endpush