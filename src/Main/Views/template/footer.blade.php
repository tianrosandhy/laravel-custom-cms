@if(setting('admin.theme') == 'klorofil')
  @include ('main::template.footer-klorofil')
@else
  @include ('main::template.footer-pages')
@endif