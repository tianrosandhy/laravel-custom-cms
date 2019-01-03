@if(setting('admin.theme') == 'klorofil')
  @include ('main::auth.register-klorofil')
@else
  @include ('main::auth.register-pages')
@endif