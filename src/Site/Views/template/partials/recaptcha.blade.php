<button class="btn btn-danger g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITEKEY') }}" data-callback="contactSubmit" data-size="invisible">Send Message</button>

@push ('script')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
function contactSubmit(){
	$(".contact-form-form").submit();
}
</script>
@endpush