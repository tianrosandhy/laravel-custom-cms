@extends ("main::master")
@include ('main::assets.dropzone')
<?php
if(!isset($multi_language)){
	$multi_language = false; //default fallback
}
?>
@section ('content')

<h3>{{ $title }}</h3>
<div class="padd">
	<a href="{{ url()->route($back) }}" class="btn btn-sm btn-default">&laquo; Back</a>
</div>

@include ('main::inc.lang-switcher', [
	'model' => $forms->model,
	'reload' => false
])

<form action="" method="post">
	{{ csrf_field() }}
	<div class="panel panel-default">
		<div class="panel-body ov">

			<div class="row">
				<?php $width = 0; ?>
				@foreach($forms->structure as $row)
					@if($row->hide_form == true)
						@php continue; @endphp
					@endif
					<?php
					$width += $row->form_column;
					if($width > 12){ //kalo lebarnya lebih dari 12 kolom, langsung tutup
						$width = 0;
						echo '</div><div class="row">'; //bikin baris baru
					}
					?>
					<div class="col-md-{{ $row->form_column }} col-sm-12">
						<div class="form-group">
							<label for="{{ $row->input_attribute['id'] }}">{{ $row->name }}</label>
							@if($multi_language)
								@include ('main::inc.dynamic_input_multilanguage')
							@else
								@include ('main::inc.dynamic_input_singlelanguage')
							@endif
						</div>
					</div>
					<?php
					if($width == 12){
						$width = 0;
						echo '</div><div class="row">'; //bikin baris baru
					}
					?>
				@endforeach
			</div>

			@if(isset($additional_field))
			{!! $additional_field !!}
			@endif

			<div class="padd">
				<button class="btn btn-primary">Save</button>
			</div>
			
		</div>
	</div>
</form>

@stop