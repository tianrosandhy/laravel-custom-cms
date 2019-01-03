<!-- Slider Start -->
<div class="slider-area lazy" data-src="{{ asset('assets/img/slider/slider-2.jpg') }}">
    <div class="slider-active-2 owl-carousel">
    	@foreach($slider as $row)
        <div class="single-slider bg-img pt-50 height-100vh d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="slider-text-2 slider-animated-1">
                            <h1 class="animated">
                              {!! $row->title !!}
                            </h1>
                            <h4 class="animated">{{ $row->description }}</h4>
                            <div class="slider-btn-2 mt-30">
                                <a class="animated btn-hover" href="{{ url('contact') }}">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>