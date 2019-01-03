<!-- BEGIN SIDEBAR -->
    <!-- BEGIN SIDEBPANEL-->
<div class="page-sidebar" data-pages="sidebar">

  <!-- BEGIN SIDEBAR MENU HEADER-->
  <div class="sidebar-header">
    <img src="{{ Storage::url(setting('admin.logo', config('cms.admin.logo'))) }}" alt="logo" class="brand" height="35">
  </div>
  <!-- END SIDEBAR MENU HEADER-->
  <!-- START SIDEBAR MENU -->
  <div class="sidebar-menu">
    <!-- BEGIN SIDEBAR MENU ITEMS-->
    <ul class="menu-items m-t-30">
      @foreach(CMS::navigation() as $group => $data)
      <li {!! $data['active'] ? 'class="open active"' : '' !!}>
        <a href="{{ $data['url'] }}">
          <span class="title">{{ $group }}</span>
          @if(isset($data['submenu']))
          <span class="arrow"></span>
          @endif
        </a>
        <span class="icon-thumbnail"><i class="{{ $data['icon'] }}"></i></span>
        @if(isset($data['submenu']))
          <ul class="sub-menu">
          @foreach($data['submenu'] as $subgroup => $subdata)
            <li {!! $subdata['active'] ? 'class="active"' : '' !!}>
              <a href="{{ $subdata['url'] }}">
                <span class="title">{{ $subgroup }}</span>
                @if(isset($subdata['submenu']))
                <span class="arrow"></span>
                @endif
              </a>
              <span class="icon-thumbnail"><i class="{{ $subdata['icon'] }}"></i></span>

              @if(isset($subdata['submenu']))
              <ul class="sub-menu">
              @foreach($subdata['submenu'] as $ssubgroup => $ssubdata)
                <li {!! $ssubdata['active'] ? 'class="active"' : '' !!}>
                  <a href="{{ $ssubdata['url'] }}">
                    <span class="title">{{ $ssubgroup }}</span>
                    @if(isset($ssubdata['submenu']))
                    <span class="arrow"></span>
                    @endif
                  </a>
                  <span class="icon-thumbnail"><i class="{{ $ssubdata['icon'] }}"></i></span>

                  
                </li>
              @endforeach
              </ul>
            @endif

            </li>
          @endforeach
          </ul>
        @endif
      </li>
      @endforeach
    </ul>
    <div class="clearfix"></div>
  </div>
  <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->