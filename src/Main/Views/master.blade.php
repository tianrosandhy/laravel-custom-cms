@if(setting('admin.theme') == 'klorofil')
  @include ('main::klorofil-master')
@else
  @include ('main::pages-master')
@endif