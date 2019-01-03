@if(is_admin_login())
<!-- START User Info-->
<div class="userinfo-holder m-t-10">
  <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
    <span class="semi-bold">{{ admin_data('name') }}</span>
  </div>
  <div class="dropdown pull-right">
    <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="thumbnail-wrapper d32 circular inline m-t-5">
      <img src="{{ (strlen(admin_data('image')) == 0) ? asset('maxsol/img/default-user.png') : (ImageService::pathExists(admin_data('image')) ? Storage::url(ImageService::getName(admin_data('image'), 'cropped')) : asset('maxsol/img/default-user.png')) }}" alt="" data-src="{{ (strlen(admin_data('image')) == 0) ? asset('maxsol/img/default-user.png') : (ImageService::pathExists(admin_data('image')) ? Storage::url(ImageService::getName(admin_data('image'), 'cropped')) : asset('maxsol/img/default-user.png')) }}" width="32" height="32">
  </span>
    </button>
    <ul class="dropdown-menu profile-dropdown" role="menu">
      <li>
      	<a href="{{ url('/') }}" target="_blank"><i class="pg-settings_small"></i> Go To Site</a>
      </li>
      <li>
      	<a href="{{ admin_url('my-profile') }}"><i class="pg-outdent"></i> My Profile</a>
      </li>
      <li class="bg-master-lighter">
        <a href="{{ admin_url('logout') }}" class="clearfix">
          <span class="pull-left">Logout</span>
          <span class="pull-right"><i class="pg-power"></i></span>
        </a>
      </li>
    </ul>
  </div>
</div>
<!-- END User Info-->
@endif