<!-- navbar-fixed-top-->
<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
  <div class="navbar-wrapper">
    <div class="navbar-header">
      <ul class="nav navbar-nav">
        <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
        <li class="nav-item"><a href="{{ admin_url('/') }}" class="navbar-brand nav-link">
          @include ('main::template.components.logo')
        </a></li>
        <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
      </ul>
    </div>
    <div class="navbar-container content container-fluid">
      <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
        <ul class="nav navbar-nav">
          <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>
        </ul>
        <ul class="nav navbar-nav float-xs-right">
          @if(config('cms.lang'))
          <li class="dropdown dropdown-language nav-item"><a id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">
            @if(current_lang() == 'en')
            <i class="flag-icon flag-icon-gb"></i>
            @else
            <i class="flag-icon flag-icon-id"></i>
            @endif
          </a>
            <div aria-labelledby="dropdown-flag" class="dropdown-menu">
              <a href="#" data-lang="en" class="dropdown-item btn-lang-switcher reload"><i class="flag-icon flag-icon-gb"></i> English</a>
              <a href="#" data-lang="id" class="dropdown-item btn-lang-switcher reload "><i class="flag-icon flag-icon-id"></i> Indonesian</a>
          </li>
          @endif


          @if(config('cms.admin.components.userinfo'))
          <li class="dropdown dropdown-user nav-item">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
              <span class="avatar avatar-online">
                <img src="{{ (strlen(admin_data('image')) == 0) ? admin_asset('img/default-user.png') : (ImageService::pathExists(admin_data('image')) ? storage_url(ImageService::getName(admin_data('image'), 'cropped')) : admin_asset('img/default-user.png')) }}" alt="" data-src="{{ (strlen(admin_data('image')) == 0) ? admin_asset('img/default-user.png') : (ImageService::pathExists(admin_data('image')) ? storage_url(ImageService::getName(admin_data('image'), 'cropped')) : admin_asset('img/default-user.png')) }}" width="32" height="32" alt="avatar">
                <i></i>
              </span>
              <span class="user-name">{{ admin_data('name') }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ url('/') }}" target="_blank" class="dropdown-item">
                <i class="icon-head"></i> Go To Site
              </a>
              <a href="{{ admin_url('my-profile') }}" class="dropdown-item">
                <i class="icon-mail6"></i> My Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ admin_url('logout') }}" class="dropdown-item">
                <i class="icon-power3"></i> Logout
              </a>
            </div>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</nav>
