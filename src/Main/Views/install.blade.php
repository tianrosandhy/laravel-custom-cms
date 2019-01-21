<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Maxsol CMS Installer</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>
<body>

<div class="container">
	<center style="padding-top:2em;">
		@if(!$publish)
		<img src="{{ asset('maxsol/img/logo_maxsol.png') }}" alt="CMS Maxsol" style="height:40px">
		@endif
		<h2>CMS Install</h2>
	</center>

	@if(session('error'))
	<div class="alert alert-danger">{{ session('error') }}</div>
	@endif
	
	@if(!$has_install)
		<div class="panel panel-body">
			<ul class="list-group">
				<li class="list-group-item"><strong>Database Connection</strong> : {!! $db ? '<span class="label label-danger">Failed : '.$db.'</span>' : '<span class="label label-success">OK</span>' !!}</li>
				<li class="list-group-item"><strong>CMS Vendor Publish</strong> : {!! $publish ? '<span class="label label-danger">Failed : '.$publish.'</span>' : '<span class="label label-success">OK</span>' !!}</li>
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
			<p>It's okay, we'll run them for you..</p>
		</div>
		@endif

		@if($publish)
		<div class="alert alert-warning">
			<strong class="text-uppercase">CMS Vendor Publish Debug</strong>
			<br>
			<p>It's okay, we'll publish the assets for you..</p>
		</div>
		@endif

		<br>
		<br>
		<br>


		@if(!$db)
		<form action="" method="post">
			{{ csrf_field() }}
			<div class="form-group">
				<label>Site Name</label>
				<input type="text" class="form-control" name="title">
			</div>
			<div class="form-group">
				<label>Site Description</label>
				<input type="text" class="form-control" name="description">
			</div>
			<br>
			<br>
			<div class="form-group">
				<label>Default Admin Full Name</label>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Default Admin Email</label>
						<input type="email" name="email" class="form-control">
					</div>
					
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Default Admin Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					
				</div>
			</div>
			<button class="btn btn-primary">Run Installation</button>
		</form>
		@endif

		<br>
		<br>
		<br>
		<br>
		<br>
	@else
	<div class="alert alert-danger">The CMS has been installed.</div>
	@endif

</div>

</body>
</html>