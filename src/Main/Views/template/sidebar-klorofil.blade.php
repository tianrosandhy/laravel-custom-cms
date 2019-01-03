<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
  <div class="sidebar-scroll">
    <nav>
      <ul class="nav sidebar-nav">
        @foreach(CMS::navigation() as $group => $data)        
        <li>
          <a href="{{ isset($data['submenu']) ? '#'. slugify($group) : $data['url'] }}" {!! $data['active'] ? 'class="active"' : '' !!} {!! isset($data['submenu']) ? 'data-toggle="collapse" data-target="#'.slugify($group).'"' : '' !!}>
            <i class="{{ $data['icon'] }}"></i> 
            <span>{{ $group }}</span>
            @if(isset($data['submenu']))
            <i class="icon-submenu lnr lnr-chevron-left"></i>
            @endif
          </a>
          @if(isset($data['submenu']))
          <div id="{{ slugify($group) }}" class="collapse">
            <ul class="nav">
              @foreach($data['submenu'] as $subgroup => $subdata)
              <li>
                <a href="{{ $subdata['url'] }}" {!! $subdata['active'] ? 'class="active"' : '' !!} {!! isset($subdata['submenu']) ? 'data-toggle="collapse" data-target="#'.slugify($subgroup).'"' : '' !!}>
                  <i class="{{ $subdata['icon'] }}"></i>
                  <span>{{ $subgroup }}</span>
                  @if(isset($subdata['submenu']))
                  <i class="icon-submenu lnr lnr-chevron-left"></i>
                  @endif
                </a>

                @if(isset($subdata['submenu']))
                <div id="{{ slugify($group) }}" class="collapse">
                  <ul class="nav">
                    @foreach($subdata['submenu'] as $ssubgroup => $ssubdata)
                    <li>
                      <a href="{{ $ssubdata['url'] }}" {!! $ssubdata['active'] ? 'class="active"' : '' !!} {!! isset($ssubdata['submenu']) ? 'data-toggle="collapse" data-target="#'.slugify($ssubgroup).'"' : '' !!}>
                        <i class="{{ $ssubdata['icon'] }}"></i>
                        <span>{{ $ssubgroup }}</span>
                        @if(isset($ssubdata['submenu']))
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                        @endif
                      </a>
                      
                    </li>
                    @endforeach
                  </ul>
                </div>
                @endif


              </li>
              @endforeach
            </ul>
          </div>
          @endif
        </li>
        @endforeach

      </ul>
    </nav>
  </div>
</div>
<!-- END LEFT SIDEBAR -->