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
                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Login to Admin Panel</span></h6>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <form class="form-horizontal form-simple" action="" novalidate method="post">
                    	{{ csrf_field() }}
                        <fieldset class="form-group position-relative has-icon-left mb-0">
                            <input type="email" class="form-control form-control-lg input-lg" id="user-name" placeholder="Your Email" maxlength="50" required name="email">
                            <div class="form-control-position">
                                <i class="icon-head"></i>
                            </div>
                        </fieldset>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Enter Password" required maxlength=50 name="password">
                            <div class="form-control-position">
                                <i class="icon-key3"></i>
                            </div>
                        </fieldset>
                        <fieldset class="form-group row">
                            <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                <fieldset>
                                    <input type="checkbox" id="remember-me" value="1" class="chk-remember" name="remember">
                                    <label for="remember-me"> Remember Me</label>
                                </fieldset>
                            </div>
                            <div class="col-md-6 col-xs-12 text-xs-center text-md-right"><a href="#" data-toggle="modal" data-target="#resetPasswordModal" class="card-link">Forgot Password?</a></div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i> Log In</button>
                    </form>
                </div>
            </div>
            <div class="card-footer">
                <div>
                    <p class="float-sm-left text-xs-center m-0"><a href="#" data-toggle="modal" data-target="#resendModal" class="card-link">Resend Validation Email</a></p>
                    <p class="float-sm-right text-xs-center m-0">Dont have an account? <a href="{{ admin_url('register') }}" class="card-link">Register</a></p>
                </div>
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
