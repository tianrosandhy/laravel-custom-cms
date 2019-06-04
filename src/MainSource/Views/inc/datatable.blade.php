<div class="container-fluid">
	<div class="row">
	<?php
	$lp = 0;
	?>
	@foreach($structure as $row)
		@if($row->hide_table == false)
			@if($row->searchable)
			<div class="col-sm-4">
				<div class="form-group custom-form-group searchable">
					<label class="text-uppercase">Search {{ $row->name }}</label>
					<div>
						<?php
						$rfield = str_replace('[]', '', $row->field);
						?>
						@if($row->data_source == 'text')
						<input type="text" name="datatable_filter[{{ $rfield }}]" id="datatable-search-{{ $rfield }}" placeholder="Search {{ $row->name }}" class="form-control {{ ($row->input_type == 'date' || $row->input_type == 'daterange') ? 'datepicker' : '' }}" <?php 
							//manage data-mask if available
							if($row->input_type == 'date'){
								echo 'data-mask="0000-00-00"';
							}
							if($row->input_type == 'time'){
								echo 'data-mask="00:00"';
							}
							if($row->input_type == 'tel'){
								echo 'data-mask="00000000000000"';
							}
						 ?>>
						@else
							@if(isset($row->data_source->output))
								<?php $source = $row->data_source->output; ?>
							@else
								<?php $source = $row->data_source; ?>
							@endif
						<select name="datatable_filter[{{ $rfield }}]" id="datatable-search-{{ $rfield }}" class="form-control">
							<option value="">Search {{ $row->name }}</option>
							@foreach($source as $ids => $datas)
							<option value="{{ $ids }}">{{ $datas }}</option>
							@endforeach
						</select>
						@endif
					</div>
				</div>
			</div>
			<?php
			$lp++;
			if($lp % 3 == 0){
				echo '</div><div class="row">';
			}
			?>
			@endif
		@endif
	@endforeach
	</div>
</div>

<div class="card card-body ov">
	<table class="table data-table">
		<thead>
			<tr>
				@foreach($structure as $row)
					@if($row->hide_table == false)
						<th data-field="{{ $row->field }}" data-orderable="{{ $row->orderable }}"  id="datatable-{{ $row->field }}">{!! $row->name !!}</th>
					@endif
				@endforeach
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>	
</div>
