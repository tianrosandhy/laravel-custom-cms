<!DOCTYPE html>
<html>
  <head>
  	@include ('main::template.metadata')
  </head>
  <body class="fixed-header menu-pin menu-behind">
    <div class="login-wrapper ">
      <!-- START Login Background Pic Wrapper-->
      <div class="bg-pic">
        <!-- START Background Pic-->
        @if(setting('admin.login_background'))
        <img src="{{ Storage::url(thumbnail(setting('admin.login_background'), 'large')) }}">
        @endif
        <!-- END Background Pic-->

        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
          <h2 class="semi-bold text-white">
          	{{ setting('site.title') }}
          </h2>
          <p class="small">
          	{{ setting('site.subtitle') }}
          </p>
        </div>
        <!-- END Background Caption-->
      </div>
      <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
      <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
          <img src="{{ Storage::url(setting('admin.logo', config('cms.admin.logo'))) }}" alt="" height=35>

          <!-- START Login Form -->
          <form id="form-login" class="p-t-15" role="form" action="" method="post">
            {{ csrf_field() }}
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Email</label>
              <div class="controls">
                <input type="text" name="email" placeholder="Email" class="form-control" required>
              </div>
            </div>
            <!-- END Form Control-->
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Password</label>
              <div class="controls">
                <input type="password" class="form-control" name="password" placeholder="Credentials" required>
              </div>
            </div>
            <!-- START Form Control-->
            <div class="row">
              <div class="col-md-6 no-padding sm-p-l-10">
                <div class="checkbox ">
                  <input type="checkbox" name="remember" value="1" id="checkbox1">
                  <label for="checkbox1">Keep Me Signed in</label>
                  <button class="btn btn-primary btn-cons m-t-10" type="submit">Sign in</button>
                </div>
              </div>
              @if(config('cms.admin.register'))
              <div class="col-md-6">
                
                <div class="text-info small padd">Still not have an account? <a href="{{ admin_url('register') }}">Create Account!</a></div>
                <div class="text-info small padd">Registered already but still not receive the validation link? <a href="#" data-toggle="modal" data-target="#resendModal">Click here</a></div>
                <div class="text-info small padd">Forgot your password or wanna reset your password? <a href="#" data-toggle="modal" data-target="#resetPasswordModal">Click here</a></div>

              </div>
              @endif
            </div>
            <!-- END Form Control-->
          </form>
         
        </div>
      </div>
      <!-- END Login Right Container-->
    </div>

    @include ('main::auth.partials.resend-validation')
    @include ('main::auth.partials.reset-password')
    
    @include ('main::template.scripts')
  </body>
</html>