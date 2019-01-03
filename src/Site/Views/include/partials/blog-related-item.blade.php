<div class="col-lg-4 col-md-4 col-12">
    <div class="related-blog-wrap mb-30">
        <a href="{{ url()->route('front.post.detail', ['slug' => $data->slug]) }}"><img class="lazy" data-src="{{ $data->getThumbnailUrl('image', 'medium') }}" alt="{{ $data->title }}"></a>
        <div class="related-blog-content">
            <h4><a onclick="gtr('Related Post')" href="{{ url()->route('front.post.detail', ['slug' => $data->slug]) }}">{{ $data->title }}</a></h4>
        </div>
    </div>
</div>
