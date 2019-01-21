<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
  <div class="main-menu-header">

  </div>
  <div class="main-menu-content">
    <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">

      @foreach(CMS::navigation() as $group => $data)        
      <li class="nav-item {!! $data['active'] ? 'active' : '' !!}">
      	<a href="{{ isset($data['submenu']) ? '#'. slugify($group) : $data['url'] }}" ><i class="{{ $data['icon'] }}"></i><span class="menu-title">{{ $group }}</span></a>
      	@if(isset($data['submenu']))
        <ul class="menu-content">
        	@foreach($data['submenu'] as $subgroup => $subdata)
          <li class="{!! $subdata['active'] ? 'active' : '' !!}"><a href="{{ $subdata['url'] }}"  class="menu-item">{{ $subgroup }}</a>
          	@if(isset($subdata['submenu']))
            <ul class="menu-content">
            	@foreach($subdata['submenu'] as $ssubgroup => $ssubdata)
              <li class="{{ $ssubdata['active'] ? 'active' : '' }}"><a href="{{ $ssubdata['url'] }}"class="menu-item">{{ $ssubgroup }}</a>
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
  </div>
  <!-- include includes/menu-footer-->
  <!-- main menu footer-->
</div>
<!-- / main menu-->