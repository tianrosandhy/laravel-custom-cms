@if(setting('admin.theme') == 'klorofil')
  @include ('main::template.header-klorofil')
@else
  @include ('main::template.header-pages')
@endif