@if(isset($data['maxId']))
	<button type="button" class="btn-ctrlpage btn btn-info btn-sm" name="nextId" value="{{ $data['maxId'] }}">Next Page</button>
@endif