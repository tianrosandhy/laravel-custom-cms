<?php
$url_target = url()->route('front.post.detail', ['slug' => $row->slug]);
?>
<div class="col-lg-4 col-md-6">
    <div class="blog-wrap mb-30">
        <div class="hover-1 more-feature-margin">
            <div class="blog-img">
                <a href="{{ $url_target }}">
                    <img alt="{{ $row->title }}" data-src="{{ $row->getThumbnailUrl('image', 'small') }}" class="auto-cover h-200 lazy">
                </a>
            </div>
            <div class="blog-content">
                <div class="blog-meta">
                    <h4><a href="{{ $url_target }}">{{ $row->title }}</a></h4>
                    <a href="{{ $url_target }}">
                        <i class="ti-arrow-right normally-none"></i>
                    </a>
                </div>
                <span>{{ date('d F Y', strtotime($row->created_at)) }}</span>
            </div>
            <div class="blog-hover-content">
                <h4><a href="{{ $url_target }}">{{ $row->title }}</a></h4>
                <span>{{ date('d F Y', strtotime($row->created_at)) }}</span>
                <div class="blog-more">
                    <a href="{{ $url_target }}">Read More</a>
                     <a href="{{ $url_target }}"><i class="ti-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>