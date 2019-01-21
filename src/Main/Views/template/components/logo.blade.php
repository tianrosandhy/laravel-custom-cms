<?php
$logo_image = admin_asset('img/logo_maxsol.png');
if(strlen(setting('admin.logo')) > 0){
	if(Storage::exists(setting('admin.logo'))){
		$logo_image = Storage::url(setting('admin.logo'));
	}
}
?>
<img src="{{ $logo_image }}" alt="{{ setting('site.title') }}" style="height:{{ isset($height) ? $height : '35' }}px">
