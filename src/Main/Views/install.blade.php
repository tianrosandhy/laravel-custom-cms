<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Maxsol CMS Installer</title>
	<link rel="stylesheet" href="{{ asset('maxsol/css/backend.css') }}">
	<link href="{!! admin_asset('assets/plugins/pace/pace-theme-flash.css') !!}" rel="stylesheet" type="text/css" />
	<link class="main-stylesheet" href="{!! admin_asset('assets/css/style.css') !!}" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container">
	<center style="padding-top:2em;">
		<img src="{{ asset('maxsol/img/logo_maxsol.png') }}" alt="CMS Maxsol" style="height:40px">
		<h2>CMS Install</h2>
	</center>

	@if(session('error'))
	<div class="alert alert-danger">{{ session('error') }}</div>
	@endif

	<div class="panel panel-body">
		<ul class="list-group">
			<li class="list-group-item"><strong>Database Connection</strong> : {!! $db ? '<span class="label label-danger">Failed : '.$db.'</span>' : '<span class="label label-success">OK</span>' !!}</li>
			<li class="list-group-item"><strong>Module Namespace</strong> : {!! $module ? '<span class="label label-danger">Failed : '.$module.'</span>' : '<span class="label label-success">OK</span>' !!}</li>
			<li class="list-group-item"><strong>Symlink</strong> : {!! $symlink ? '<span class="label label-danger">Failed : '.$symlink.'</span>' : '<span class="label label-success">OK</span>' !!}</li>
		</ul>
	</div>
	
	@if($db)
	<div class="alert alert-danger">
		<strong class="text-uppercase">Database Connection Debug</strong>
		<br>
		<p>Manage your database connection in <em><u>.env</u></em> file. Please make sure the database name provided is exists</p>
	</div>
	@endif
	
	@if($module)
	<div class="alert alert-warning">
		<strong class="text-uppercase">Module Namespace Debug</strong>
		<br>
		<p>Open your composer.json file, look at the key "autoload" -> "psr-4". Add new key : <br>
			<strong>"Module\\" : "modules/"</strong><br>
		after the "App\\" key.</p>
		<p>Dont forget to create directory <strong>"modules"</strong> in base directory too.</p>
	</div>
	@endif
	
	@if($symlink)
	<div class="alert alert-warning">
		<strong class="text-uppercase">Symlink Debug</strong>
		<br>
		<p>Run command : "php artisan storage:link" in terminal</p>
	</div>
	@endif


	@if(!$db)
	<form action="" method="post">
		<div class="form-group">
			<label>Site Name</label>
			<input type="text" class="form-control" name="title">
		</div>
		<div class="form-group">
			<label>Site Description</label>
			<input type="text" class="form-control" name="description">
		</div>
		<button class="btn btn-primary">Run Installation</button>
	</form>
	@endif
</div>


<script src="{!! admin_asset('assets/plugins/jquery/jquery-1.11.1.min.js') !!}" type="text/javascript"></script>
<script src="{{ asset('maxsol/js/backend.js') }}"></script>
</body>
</html>