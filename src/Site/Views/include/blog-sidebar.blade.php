<div class="pro-sidebar-style pl-20 sidebar-mrg">
    <div class="sidebar-widget mb-55">

        <h4 class="pro-sidebar-title">Recent Blogs</h4>
        <div class="sidebar-project-wrap mt-30">
            @foreach($sidebar['recent_blog'] as $blog)
            <div class="single-sidebar-project">
                <div class="sidebar-project-img">
                    <a style="background-image:url('{{ $blog->getThumbnailUrl('image', 'thumb') }}')" class="force-square" href="{{ url()->route('front.post.detail', ['slug' => $blog->slug]) }}">
                        <img src="{{ $blog->getThumbnailUrl('image', 'thumb') }}" alt="{{ $blog->title }}">
                    </a>
                </div>
                <div class="sidebar-project-content">
                    <span>{{ date('d F Y H:i:s', strtotime($blog->created_at)) }}</span>
                    <h4><a href="{{ url()->route('front.post.detail', ['slug' => $blog->slug]) }}">{{ strtoupper($blog->title) }}</a></h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="sidebar-widget mt-50">
        <h4 class="pro-sidebar-title">Categories </h4>
        <div class="sidebar-categori mt-25">
            <ul>
                @foreach($sidebar['categories'] as $cat)
                <li><a href="{{ url()->route('front.category', ['slug' => $cat->slug]) }}">{{ $cat->name }} <span>({{ $cat->posts->count() }})</span></a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="sidebar-widget mt-55">
        <h4 class="pro-sidebar-title">Instagram </h4>
        <div class="instagram-img mt-30">
            <ul>
                @foreach($sidebar['instagram'] as $ins)
                <li><a onclick="gtr('Instagram Click')" class="force-square" href="{{ $ins->link }}" target="_blank" style="background-image:url('{{ str_replace("\\", '/', Storage::url($ins->stored_url)) }}')"><img src="{{ Storage::url($ins->stored_url) }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="sidebar-widget mt-55">
        <h4 class="pro-sidebar-title">Keep In Touch </h4>
        <div class="blog-sidebar-social mt-30">
            <ul>
                <li><a sync href="{{ setting('static.facebook') }}"><i class="ti-facebook"></i></a></li>
                <li><a sync href="{{ setting('static.instagram') }}"><i class="ti-instagram"></i></a></li>
                <li><a onclick="gtr('Whatsapp Chat Button')" sync href="{{ setting('static.whatsapp') }}"><i class="fa fa-whatsapp"></i></a></li>
            </ul>
        </div>
    </div>

</div>