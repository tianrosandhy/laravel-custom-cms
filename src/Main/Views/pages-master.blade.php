<!DOCTYPE html>
<html>
  <head>
	@include ('main::template.metadata')
  </head>
  <body class="fixed-header pages"> 
    @include ('main::template.sidebar')
    
    <!-- START PAGE-CONTAINER -->
    <div class="page-container">
      @include ('main::template.header')
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper">
        <!-- START PAGE CONTENT -->
        <div class="content">
          @include ('main::template.breadcrumbs')
          <!-- START CONTAINER FLUID -->
          <div class="container-fluid container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            @yield ('content')
            <!-- END PLACE PAGE CONTENT HERE -->
          </div>
          <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        @include ('main::template.footer')
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->

    @stack ('additional')

    
    @include ('main::template.scripts')
  </body>
</html>