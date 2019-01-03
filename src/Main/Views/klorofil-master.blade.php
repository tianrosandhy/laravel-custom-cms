<!doctype html>
<html lang="en">

<head>
  @include ('main::template.metadata')
</head>

<body class="klorofil">
  <!-- WRAPPER -->
  <div id="wrapper">
    @include ('main::template.header')
    @include ('main::template.sidebar')
    <!-- MAIN -->
    <div class="main">
      <!-- MAIN CONTENT -->
      <div class="main-content">
        <div class="container-fluid">
          
          @yield ('content')

        </div>
      </div>
      <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->
    @include ('main::template.footer')
  </div>
  <!-- END WRAPPER -->
  @include ('main::template.scripts')

</body>

</html>
