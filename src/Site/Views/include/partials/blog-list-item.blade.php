<div class="blog-wrap-3 mb-60 blog-bg-white blog-shadow">
    <div class="blog-img hover-3 mb-45">
        <a href="{{ url()->route('front.post.detail', ['slug' => $row->slug]) }}">
            <img class="lazy" data-src="{{ $row->getThumbnailUrl('image', 'large') }}" alt="{{ $row->title }}">
        </a>
    </div>
    <div class="blog-content-3 white-bg-content">
        <?php
        $catt = $row->categories->first();
        ?>
        @if(isset($catt->category->name))
        <a href="{{ url()->route('front.category', ['slug' => $catt->slug]) }}" class="category">{{ $catt->category->name }}</a>
        @endif
        <h4><a href="{{ url()->route('front.post.detail', ['slug' => $row->slug]) }}">{{ $row->title }}</a></h4>
        <p><?php
        if(strlen($row->excerpt) > 0){
            echo $row->excerpt;
        }
        else{
            echo descriptionMaker($row->body);
        }
        ?></p>
        <div class="blog-bottom">
            <div class="blog-meta-3">
                <ul>
                    <li>{{ date('d F Y H:i:s', strtotime($row->created_at)) }}</li>
                    <li>
                        <a href="">{{ $row->likes->count() }} <i class="fa fa-heart"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>