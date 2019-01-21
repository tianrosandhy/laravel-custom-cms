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
	<thead>
		<tr>
			@foreach($structure as $row)
				@if($row->hide_table == false)
				<th data-searchable="{{ $row->searchable }}">
					@if($row->searchable)
						<?php
						$rfield = str_replace('[]', '', $row->field);
						?>
						@if($row->data_source == 'text')
						<input type="text" name="datatable_filter[{{ $rfield }}]" id="datatable-search-{{ $rfield }}" placeholder="Search {{ $row->name }}" class="form-control {{ $row->input_type == 'date' ? 'datepicker' : '' }}">
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
					@endif
				</th>
				@endif
			@endforeach
			<th></th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>