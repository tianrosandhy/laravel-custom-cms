@extends ('site::template.master')
@section ('content')
<div class="blog-area pt-100 pb-80 gray-bg-4 mobaddpadd">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="blog-classic-wrap">
                    {!! $data !!}
                </div>
                <div class="other-page">
                    <div class="blog-page-wrap" data-page="2" style="display:none;">{!! $page2 !!}</div>
                </div>

                @if(strlen(trim($page2)) > 0)
                <div class="single-shortcode-btn blue-button button-icon small-button mb-30 text-center">
                    <a class="btn-hover load-more-button" href="#" data-page="2" {!! isset($is_category) ? 'data-category="'.$cat_id.'"' : '' !!}>Load More</a>
                </div>
                @endif

            </div>
            <div class="col-xl-4 col-lg-5">
                @include ('site::include.blog-sidebar')
            </div>
        </div>
    </div>
</div>
@stop