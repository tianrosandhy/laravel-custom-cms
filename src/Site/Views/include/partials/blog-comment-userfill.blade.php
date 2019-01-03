<div class="single-blog-comment mb-60">
    <div class="blog-comment-content">
        <div class="comment-name-reply">
            <span>{{ $comment->last_name }}</span>
            <span>({{ hideEmail($comment->email) }})</span>
            <span>{{ date('d F Y H:i:s', strtotime($comment->created_at)) }}</span>
        </div>
        <p>{{ strip_tags($comment->message) }}</p>
    </div>
</div>
@if(isset($comment->commented->message))
	@include ('site::include.partials.blog-comment-reply', [
		'comment' => $comment->commented
	])
@endif