@extends ('site::template.master')
@section ('content')
<div class="single-portfolio-area pt-75">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="row mx-auto justify-content-center">
                    <div class="col-sm-2">
                        <div class="zoom-hover">
                            <img alt="{{ $data->title }}" src="{{ $data->getThumbnailUrl('image', 'small') }}">
                        </div>
                    </div>
                </div>
            	<div class="single-port-title mb-40 text-center">
                    <h3>{{ $data->title }}</h3>
                </div>

                <div class="single-portfolio-wrap single-port-style4 ">
                    <div class="single-port-peragraph-wrap text-center">
                        {!! $data->description !!}
                    </div>
                    <?php
                    $desktop_image = $data->getThumbnailsUrl('desktop_image', 'large', false);
                    ?>
                    @if($desktop_image)
                    @foreach($desktop_image as $desk)
                    <div class="zoom-hover mb-50">
                        <img class="lazy" data-src="{{ $desk }}">
                    </div>
                    @endforeach
                    @endif

                    <div class="row mx-auto justify-content-center">
                        <?php
                        $mobile_image = $data->getThumbnailsUrl('mobile_image', 'medium', false);
                        ?>
                        @if($mobile_image)
                        @foreach($mobile_image as $mob)
                        <div class="col-sm-4">
                            <div class="zoom-hover mb-50">
                                <img class="lazy" data-src="{{ $mob }}">
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-port-next-prev gray-bg-4 mt-80">
        <div class="container">
            <div class="port-next-prev-wrap">
                @if($prev <> $slug)
                <div class="port-prev-btn">
                    <a href="{{ url()->route('front.project.detail', ['slug' => $prev]) }}"><i class="ti-angle-left"></i> Prev</a>
                </div>
                @endif
                @if($next <> $slug)
                <div class="port-next-btn">
                    <a href="{{ url()->route('front.project.detail', ['slug' => $next]) }}">Next <i class="ti-angle-right"></i></a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop