@extends ('site::template.master')

@section ('content')
<div class="contact-area pt-15 mobaddpadd">
    <div class="pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="contact-info-area">
                        <h2 class="text-right">Contact</h2>
                        <p class="text-right">Do you have some question, or project you wanna discuss with me? Please fill the form, or chat me now. </p>
                        <div class="contact-info-wrap">
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="ti-mobile"></i>
                                </div>
                                <div class="contact-info-content">
                                    <p>+62 896 2222 4614</p>
                                    <p>
                                    	<a onclick="gtr('Whatsapp Chat Button')" sync target="_blank" href="{{ setting('static.whatsapp') }}" class="btn btn-success" onclick="gtr('Whatsapp Chat Button')">
                                    		<i class="fa fa-whatsapp"></i>
                                    		Chat us Via Whatsapp
                                    	</a>
                                    </p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="ti-email"></i>
                                </div>
                                <div class="contact-info-content">
                                    <p><a href="#">me@tianrosandhy.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="pl-85">
                        <div class="contact-from contact-shadow">
                            <form id="contact-form" action="{{ url('contact') }}" method="post">
                                {{ csrf_field() }}
                                {!! CMS::honeyForm('username') !!}                                
                                <input name="first_name" type="text" placeholder="Your" maxlength="32">
                                <input name="last_name" type="text" placeholder="Name" maxlength="32">
                                <input name="email" type="text" placeholder="Email" maxlength="50">
                                <input name="phone" type="tel" placeholder="Phone Number" maxlength="15" class="mask" data-mask="0000 0000 00000">
                                <textarea name="message" placeholder="Your message"></textarea>
                                <input class="submit" type="submit" value="Send Message">
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop