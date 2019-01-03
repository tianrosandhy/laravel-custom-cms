@if(isset($data['medias']))
	<div class="panel ov">
		<table class="table">
			<thead>
				<tr>
					<th>Image</th>
					<th>URL</th>
					<th>Type</th>
					<th>Caption</th>
					<th>Likes</th>
					<th>Created At</th>
					<th></th>
				</tr>
			</thead>
			<tbody class="ig-content">
				@include ('instagram::partials.grab-list-inner')
			</tbody>
		</table>		
	</div>

	@include ('instagram::partials.control-button')
@else
	<div class="alert alert-danger alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Invalid response from Instagram API
	</div>
@endif