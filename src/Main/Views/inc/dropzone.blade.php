<?php
if(!isset($hash)){
	$hash = sha1(md5(time() . rand(1, 10000000) . uniqid() ));
}
if(!isset($name)){
	$name = 'image';
}
?>
<input type="hidden" data-hash="{{ $hash }}" name="{{ $name }}" class="dropzone_uploaded listen_uploaded_image" value="{{ isset($value) ? $value : '' }}">
<div class="row">
	<div class="{{ isset($horizontal) ? 'col-sm-6' : 'col-sm-12' }}">
		<div style="padding-bottom:.5em;">
			<span class="label label-default">Maximum Upload Size : {{ number_format((file_upload_max_size(config('cms.max_filesize.image')) / 1024 /1024), 2) }} MB</span>
		</div>
        <div class="dropzone dz-clickable mydropzone" data-hash="{{ $hash }}" style="min-height:200px; height:200px;" data-target="{{ admin_url('api/store-images') . ( isset($path) ? '?path='.$path : '' ) }}"></div>
	</div>
	<div class="{{ isset($horizontal) ? 'col-sm-6' : 'col-sm-12' }}">
		<div class="uploaded-holder" data-hash="{{ $hash }}">
			@if(isset($value))
				@if(strlen($value) > 0)
					<strong>Uploaded Image : </strong>
					<div class="uploaded">
						@if(ImageService::pathExists($value))
							<img src="{{ storage_url($value) }}" style="height:100px;">
						@else
							<img src="{{ admin_asset('img/broken-image.jpg') }}" style="height:100px;">
						@endif
						<span class="remove-asset" data-hash="{{ $hash }}">&times;</span>
					</div>
				@endif
			@endif
		</div>		
	</div>
</div>
