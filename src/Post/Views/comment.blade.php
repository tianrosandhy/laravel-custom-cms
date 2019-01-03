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
	@if(Route::has('admin.'.$hint.'.store'))
	<div class="pull-left">
		<a href="{{ url()->route('admin.'.$hint.'.store') }}" class="btn btn-primary">Add Data</a>
	</div>
	@endif

	@if(Route::has('admin.'.$hint.'.export') && config('module-setting.'.$hint.'.export_excel'))
	<div class="pull-right">
		<a href="{{ url()->route('admin.'.$hint.'.export') }}" class="btn btn-info">Export to Excel</a>
	</div>
	@endif

	<div class="pull-right">
		<a href="{{ url()->route('admin.post_comment.remove_spam') }}" class="btn btn-danger">Remove All Spam Comment</a>
	</div>
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