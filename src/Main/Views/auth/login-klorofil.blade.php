<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
  @include ('main::template.metadata')
</head>

<body>
  <!-- WRAPPER -->
  <div id="wrapper">
    <div class="vertical-align-wrap">
      <div class="vertical-align-middle">
        <div class="auth-box ">
          <div class="left">
            <div class="content">
              <form class="form-auth-small" action="" id="form-login" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="signin-email" class="control-label sr-only">Email</label>
                  <input type="email" class="form-control" id="signin-email" value="" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                  <label for="signin-password" class="control-label sr-only">Password</label>
                  <input type="password" class="form-control" id="signin-password" placeholder="Password" name="password">
                </div>
                <div class="form-group clearfix">
                  <label class="fancy-checkbox element-left">
                    <input type="checkbox" name="remember" value="1">
                    <span>Remember me</span>
                  </label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                @if(config('cms.admin.register'))
                <div class="bottom">
                  <span class="helper-text"><i class="fa fa-lock"></i> <a href="#" data-toggle="modal" data-target="#resetPasswordModal">Forgot password?</a></span>
                </div>
                <div class="small padd">Still not have an account? <a href="{{ admin_url('register') }}">Create Account!</a></div>
                <div class="small padd">Registered already but still not receive the validation link? <a href="#" data-toggle="modal" data-target="#resendModal">Click here</a></div>

                @endif

              </form>
            </div>
          </div>
          <div class="right">
            @if(setting('admin.login_background'))
            <img src="{{ Storage::url(thumbnail(setting('admin.login_background'), 'medium')) }}" style="width:100%; position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
            @endif
            <div class="overlay"></div>
            <div class="content text">
              <h1 class="heading">{{ setting('site.title') }}</h1>
              <p>{{ setting('site.subtitle') }}</p>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- END WRAPPER -->

  @include ('main::auth.partials.resend-validation')
  @include ('main::auth.partials.reset-password')
  
  @include ('main::template.scripts')

</body>

</html>
