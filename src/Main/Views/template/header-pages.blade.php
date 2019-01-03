<!-- START PAGE HEADER WRAPPER -->
<!-- START HEADER -->
<div class="header">
  <!-- START MOBILE CONTROLS -->
  <div class="container-fluid relative">
    <!-- LEFT SIDE -->
    <div class="pull-left full-height visible-sm visible-xs">
      <!-- START ACTION BAR -->
      <div class="header-inner">
        <a href="#" class="btn-link toggle-sidebar visible-sm-inline-block visible-xs-inline-block padding-5" data-toggle="sidebar">
          <span class="icon-set menu-hambuger"></span>
        </a>
      </div>
      <!-- END ACTION BAR -->
    </div>
    <div class="pull-center hidden-md hidden-lg">
      <div class="header-inner">
        <div class="brand inline">
          <img src="{{ Storage::url(setting('admin.logo', config('cms.admin.logo'))) }}" alt="logo" height=35>
        </div>
      </div>
    </div>

  </div>
  <!-- END MOBILE CONTROLS -->


  <div class="pull-left sm-table hidden-xs hidden-sm">
    <div class="header-inner">
      <div class="brand inline">
        <img src="{{ Storage::url(setting('admin.logo', config('cms.admin.logo'))) }}" alt="logo" height=35>
      </div>
      @if(config('cms.admin.components.notification'))
        @include ('main::template.components.notification')
      @endif

      @if(config('cms.admin.components.search'))
        @include ('main::template.components.search')
      @endif
    </div>
  </div>
  <div class=" pull-right">
    @if(config('cms.admin.components.quickview'))
      @include ('main::template.components.quickview')
    @endif
  </div>
  <div class=" pull-right">
    @if(config('cms.admin.components.userinfo'))
      @include ('main::template.components.userinfo')
    @endif
    
  </div>


</div>
<!-- END HEADER -->
<!-- END PAGE HEADER WRAPPER -->