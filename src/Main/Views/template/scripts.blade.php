@if(config('cms.admin.jquery_version') == 1)
<script src="{!! admin_asset('assets/plugins/jquery/jquery-1.11.1.min.js') !!}" type="text/javascript"></script>
@else
<script src="{!! admin_asset('assets/plugins/jquery/jquery-3.3.1.min.js') !!}" type="text/javascript"></script>
<script src="{!! admin_asset('assets/plugins/jquery/jquery-migrate-3.0.0.min.js') !!}" type="text/javascript"></script>
@endif

@if(setting('admin.theme') != 'klorofil')
	@if(!config('cms.admin.minified'))
	<!-- BEGIN VENDOR JS -->
	<script src="{!! admin_asset('assets/plugins/feather-icons/feather.min.js') !!}" type="text/javascript"></script>
	    <!-- BEGIN VENDOR JS -->
	<script src="{!! admin_asset('assets/plugins/pace/pace.min.js') !!}" type="text/javascript"></script>
	<script src="{!! admin_asset('assets/js/jquery-debounce.js') !!}" type="text/javascript"></script>
	<script src="{!! admin_asset('assets/plugins/modernizr.custom.js') !!}" type="text/javascript"></script>
	<script src="{!! admin_asset('assets/plugins/jquery-ui/jquery-ui.min.js') !!}" type="text/javascript"></script>
	<script src="{!! admin_asset('assets/plugins/bootstrapv3/js/bootstrap.min.js') !!}" type="text/javascript"></script>
	<script src="{!! admin_asset('assets/plugins/jquery/jquery-easy.js') !!}" type="text/javascript"></script>
	<script src="{!! admin_asset('assets/plugins/jquery-unveil/jquery.unveil.min.js') !!}" type="text/javascript"></script>
	<script src="{!! admin_asset('assets/plugins/select2/js/select2.min.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/jquery-bez/jquery.bez.min.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/jquery-ios-list/jquery.ioslist.min.js') !!}" type="text/javascript"></script>
	<script src="{!! admin_asset('assets/plugins/switchery/js/switchery.min.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/imagesloaded/imagesloaded.pkgd.min.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/jquery-actual/jquery.actual.min.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/sweetalert/sweetalert.min.js') !!}"></script>
	<!-- END VENDOR JS -->
	<!-- BEGIN CORE TEMPLATE JS -->
	<script src="{!! admin_asset('pages/js/pages.js') !!}" type="text/javascript"></script>
	<!-- END CORE TEMPLATE JS -->
	<!-- BEGIN PAGE LEVEL JS -->
	<script src="{!! admin_asset('assets/js/scripts.js') !!}" type="text/javascript"></script>
	<!-- END PAGE LEVEL JS -->
	@else
	<script src="{{ asset('maxsol/js/backend.js') }}"></script>
	@endif
@else
	@if(!config('cms.admin.minified'))
	<script src="{!! admin_asset('assets/plugins/pace/pace.min.js') !!}"></script>
	<script src="{!! admin_asset('assets/js/jquery-debounce.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/modernizr.custom.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/bootstrapv3/js/bootstrap.min.js') !!}"></script>
	<script src="{!! admin_asset('klorofil/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') !!}"></script>
	<script src="{!! admin_asset('klorofil/assets/scripts/klorofil-common.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/sweetalert/sweetalert.min.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/select2/js/select2.min.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/switchery/js/switchery.min.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') !!}"></script>
	<script src="{!! admin_asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}"></script>

	@else
	<script src="{{ asset('maxsol/js/backend-klorofil.js') }}"></script>
	@endif
@endif
<script src="{{ admin_asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ admin_asset('assets/plugins/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ admin_asset('assets/plugins/timepicker/jquery.timepicker.min.js') }}"></script>
<script src="{{ admin_asset('assets/plugins/tinymce/themes/modern/theme.min.js') }}"></script>
<script src="{{ admin_asset('assets/js/additional.js') }}"></script>

<script>
	var CSRF_TOKEN = '{{ csrf_token() }}';
	var CURRENT_URL = '{{ url()->current() }}';
	var BASE_URL = '{{ admin_url() }}';
	var SITE_URL = '{{ url('/') }}';
	var STORAGE_URL = '{{ config('filesystems.disks.public.url') }}';

	$(function(){
		@if(isset($errors))
			@if($errors->any())
				@foreach($errors->getMessages() as $error)
					swal ( "Oops" ,  "{{ $error[0] }}" ,  "error" );
				@endforeach
			@endif
		@endif

		@if(session('success'))
			swal('Success', '{{ session('success') }}', 'success');
		@endif
	});
</script>
@stack ('script')
@stack ('scripts')