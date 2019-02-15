@extends ('main::master')

@section ('content')

<h3>{!! $title !!}</h3>

@include ('main::inc.lang-switcher', [
	'model' => $datatable->model,
	'reload' => true
])

<div class="padd">
	@if(Route::has('admin.'.$hint.'.store'))
	<div class="pull-left float-xs-left">
		<a href="{{ url()->route('admin.'.$hint.'.store') }}" class="btn btn-primary">Add Data</a>
		<a href="{{ url()->route('admin.'.$hint.'.delete', ['id' => 0]) }}" class="btn btn-danger batchbox multi-delete">Delete All Selected</a>
	</div>
	@endif

	@if(Route::has('admin.'.$hint.'.export') && config('module-setting.'.$hint.'.export_excel'))
	<div class="pull-right float-xs-right">
		<a href="{{ url()->route('admin.'.$hint.'.export') }}" class="btn btn-info">Export to Excel</a>
	</div>
	@endif
	<div class="clearfix"></div>
</div>



{!! $datatable->view() !!}


@stop

@push ('script')
	@include ('main::assets.datatable', [
		'url' => url()->route('admin.'.$hint.'.datatable')
	])
@endpush