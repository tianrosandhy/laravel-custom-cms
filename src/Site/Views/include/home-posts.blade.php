@if(isset($post))
<div class="blog-area pb-90">
    <div class="container">
        <div class="section-title text-center mb-40">
            <h2>Our Posts</h2>
        </div>
        <div class="row no-gutters">
            @foreach($post as $row)
                @include ('site::include.partials.home-post-item')
            @endforeach
        </div>
    </div>
</div>
@endif