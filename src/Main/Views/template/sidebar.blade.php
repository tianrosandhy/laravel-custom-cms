@if(setting('admin.theme') == 'klorofil')
  @include ('main::template.sidebar-klorofil')
@else
  @include ('main::template.sidebar-pages')
@endif