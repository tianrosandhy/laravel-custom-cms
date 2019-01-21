<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include ('main::template.metadata')
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
<section class="flexbox-container">
    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
        <div class="card border-grey border-lighten-3 m-0">
            <div class="card-header no-border">
                <div class="card-title text-xs-center">
                    <div class="p-1">
                    	@include ('main::template.components.logo')
                    </div>
                </div>
                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Register New Admin Account </span></h6>
            </div>
            <div class="card-body collapse in">
            	<div class="card-block">
								<form id="form-register" class="p-t-15" role="form" novalidate="novalidate" method="post">
									{{ csrf_field() }}
								   <div class="row">
								      <div class="col-md-12">
								         <div class="form-group form-group-default">
								            <label>Full Name</label>
								            <input type="text" name="name" placeholder="Your Full Name" class="form-control" required="" aria-required="true" value="{{ old('name') }}">
								         </div>
								      </div>
								   </div>
								   <div class="row">
								      <div class="col-md-12">
								         <div class="form-group form-group-default">
								            <label>Email</label>
								            <input type="email" name="email" placeholder="We will send loging details to you" class="form-control" required="" aria-required="true" value="{{ old('email') }}">
								         </div>
								      </div>
								   </div>
								   <div class="row">
								      <div class="col-md-6">
								         <div class="form-group form-group-default">
								            <label>Password</label>
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

								   <button class="btn btn-primary btn-cons m-t-10" type="submit">Create a new account</button>
								</form>
            		
            	</div>
            </div>
            <div class="card-footer">

								<a href="{{ admin_url('login') }}"><i class="fa fa-arrow-left"></i> Back to Login Page</a>
            	
            </div>

        </div>
    </div>
</section>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    @include ('main::auth.partials.resend-validation')
    @include ('main::auth.partials.reset-password')

    @include ('main::template.scripts')
  </body>
</html>
