<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    @include ('main::template.metadata')
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
		@include ('main::template.header')
		@include ('main::template.sidebar')

    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
        	@yield ('content')
        </div>
      </div>
    </div>

		@include ('main::template.footer')
    @include ('main::template.modal')
		@stack ('additional')
		@include ('main::template.scripts')
  </body>
</html>
