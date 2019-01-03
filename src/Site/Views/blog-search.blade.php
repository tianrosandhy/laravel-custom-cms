@extends ('site::template.master')
@section ('content')
<div class="blog-area pt-100 pb-80 gray-bg-4 mobaddpadd">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="text-right">
                    <h3 class="mb-50">{{ $title }}</h3>
                </div>
                <div class="blog-classic-wrap">
                    {!! $out !!}
                    @if(strlen(trim($out)) == 0)
                    <div class="post-content">
                        <p>Sorry, we cannot find the post you are looking for.. <br><a href="{{ url()->route('front.post.index') }}">Back to Articles</a></p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                @include ('site::include.blog-sidebar')
            </div>
        </div>
    </div>
</div>
@stop
