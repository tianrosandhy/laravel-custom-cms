@extends ('site::template.master')
@section ('content')
<div class="breadcrumb-area bg-img breadcrumb-height" style="background-image: url('{{ $data->getThumbnailUrl('image', 'large') }}');"></div>

<div class="blog-details-area pt-70 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 ml-auto mr-auto">
                <div class="blog-details-wrap blog-details-2 pl-50 pr-50">
                    <div class="b-details-content-wrap">
                        <div class="blog-content-3 text-center mb-25">
                            <h4>{{ $data->title }}</h4>
                            <div class="blog-meta-3">
                                <ul>
                                    @if(isset($data->categories->first()->category->name))
                                    <li><a href="{{ url()->route('front.category', ['slug' => $data->categories->first()->category->slug]) }}">{{ $data->categories->first()->category->name }}</a></li>
                                    @endif
                                    <li>{{ date('d F Y H:i:s', strtotime($data->created_at)) }}</li>
                                    <li><a href="#comment-section">{{ $data->comment->count() }} Comment{{ $data->comment->count() > 1 ? 's' : '' }}</a></li>
                                </ul>
                            </div>
                        </div>

                        @include ('site::include.partials.blog-sharer')
                        
                        <div class="post-content mt-50">
                            {!! $data->body !!}
                        </div>

                        @include ('site::include.partials.blog-sharer')
                        
                        @include ('site::include.blog-related')
                        @include ('site::include.blog-comment')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include ('site::include.partials.blog-sticky-sharer')

@stop
