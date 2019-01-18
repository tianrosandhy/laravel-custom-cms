<!-- NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="brands">
    <a href="{{ admin_url('') }}">
      @include ('main::template.components.logo', ['height' => 50])
    </a>
  </div>
	<div class="navbar-btn">
		<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
	</div>

	<div class="fr">
		@include ('main::template.components.userinfo')
	</div>
	<div class="clear"></div>



</nav>
<!-- END NAVBAR -->