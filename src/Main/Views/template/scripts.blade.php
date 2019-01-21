<!-- BEGIN VENDOR JS-->
<script src="{{ admin_asset('vendor/pace/pace.min.js') }}" type="text/javascript"></script>

<script src="{{ admin_asset('js/core/libraries/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ admin_asset('js/tether.min.js') }}" type="text/javascript"></script>
<script src="{{ admin_asset('js/core/libraries/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ admin_asset('js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ admin_asset('js/unison.min.js') }}" type="text/javascript"></script>
<script src="{{ admin_asset('js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ admin_asset('js/core/app-menu.js') }}" type="text/javascript"></script>


<script src="{!! admin_asset('js/jquery-debounce.js') !!}" type="text/javascript"></script>
<script src="{!! admin_asset('js/modernizr.custom.js') !!}" type="text/javascript"></script>
<script src="{!! admin_asset('vendor/select2/js/select2.min.js') !!}"></script>
<script src="{!! admin_asset('vendor/switchery/js/switchery.min.js') !!}"></script>
<script src="{!! admin_asset('vendor/sweetalert/sweetalert.min.js') !!}"></script>
<script src="{!! admin_asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}"></script>
<script src="{!! admin_asset('vendor/bootstrap-tag/bootstrap-tagsinput.min.js') !!}"></script>

<script src="{{ admin_asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ admin_asset('vendor/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ admin_asset('vendor/timepicker/jquery.timepicker.min.js') }}"></script>
<script src="{{ admin_asset('vendor/tinymce/themes/modern/theme.min.js') }}"></script>
<script src="{{ admin_asset('js/additional.js') }}"></script>

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