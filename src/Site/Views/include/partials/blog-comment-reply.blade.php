<div class="single-blog-comment child-blog-comment mb-60 ml-70">
    <div class="blog-comment-content">
        <div class="comment-name-reply">
            <span>Administrator</span>
            <span>{{ date('d F Y H:i:s', strtotime($comment->created_at)) }}</span>
        </div>
        <p>{{ strip_tags($comment->message) }}</p>
    </div>
</div>
