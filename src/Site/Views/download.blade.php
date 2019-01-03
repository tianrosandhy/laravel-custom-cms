@extends ('site::template.master')
@section ('content')
<div class="pt-100 pb-100 download-page" align="center">
	<h3>Download "<mark>{{ $download->filename }}</mark>"</h3>
	<p style="font-size:130%;">
		Click the button below to start the download.
		@if($download->hit > 0)
		This file has been downloaded <span class="hit">{{ $download->hit }}</span> times.
		@endif
	</p>
	<center class="m-t-1">
		<a href="{{ url('download/file/'.$download->url) }}" onclick="gtr('Download File')" class="btn btn-primary" download><i class="fa fas fa-cloud-download-alt"></i> Download Now</a>
	</center>
</div>
@stop