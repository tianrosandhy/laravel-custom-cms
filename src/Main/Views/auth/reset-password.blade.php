<!DOCTYPE html>
<html>
  <head>
  	@include ('main::template.metadata')
  </head>
  <body class="fixed-header menu-pin menu-behind">
		
		<div class="register-container full-height sm-p-t-30">
			<div class="d-flex justify-content-center flex-column full-height">
				<div class="logo">
					<img src="{{ storage_url(setting('admin.logo', config('cms.admin.logo'))) }}" alt="">
				</div>

				<form id="form-register" class="p-t-15" role="form" novalidate="novalidate" method="post">
					{{ csrf_field() }}
				   
				   <div class="row">
				      <div class="col-md-12">
				         <div class="form-group form-group-default">
				            <label>Email</label>
				            <div>{{ $user->email }}</div>
				         </div>
				      </div>
				   </div>
				   <div class="row">
				      <div class="col-md-6">
				         <div class="form-group form-group-default">
				            <label>New Password</label>
				            <input type="password" name="password" placeholder="Minimum of 8 Characters" class="form-control" required="" aria-required="true">
				         </div>
				      </div>

				      <div class="col-md-6">
				         <div class="form-group form-group-default">
				            <label>Repeat Password</label>
				            <input type="password" name="password_confirmation" placeholder="Retype your password" class="form-control" required="" aria-required="true">
				         </div>
				      </div>
				   </div>

				   <button class="btn btn-primary btn-cons m-t-10" type="submit">Reset Password</button>
				</form>

			</div>
		</div>


    @include ('main::template.modal')

    @include ('main::template.scripts')
  </body>
</html>