@if(setting('admin.theme') == 'klorofil')
  @include ('main::auth.login-klorofil')
@else
  @include ('main::auth.login-pages')
@endif