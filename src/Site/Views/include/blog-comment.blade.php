<div class="blog-comments-area border-bottom-4 pb-60" id="comment-section">
    <h4 class="blog-details-title text-center">Comments</h4>
    <div class="blog-comments-wrap">
        <div class="single-blog-bundel">
            <?php
            $cm_count = 0;
            ?>
            @foreach($data->comment as $comment)
                @if(empty($comment->reply_to))
                    @if($comment->is_active == 1 && $comment->spam == 0)
                        @include ('site::include.partials.blog-comment-userfill')
                        <?php $cm_count++; ?>
                    @endif
                @endif
            @endforeach
            @if($cm_count == 0)
                <p>No comments available in this post</p>
            @endif
        </div>
    </div>
</div>
<div class="blog-reply-area pt-45">
    <h4 class="blog-details-title">Leave A Reply</h4>
    <div class="blog-form-wrapper custom-col-15">
        <form action="{{ url()->route('front.post.comment', ['id' => $data->id]) }}" method="post" class="post-comment">
            {{ csrf_field() }}
            {!! CMS::honeyForm('username') !!}
            <input type="hidden" name="nonce" value="{{ encrypt($data->id) }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="leave-form">
                        <input type="text" tabindex="-1" maxlength="50" placeholder="Name" name="first_name" class="first_name_holder" readonly>
                        <input type="text" maxlength=50 placeholder="Name" name="last_name" class="last_name_holder">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="leave-form">
                        <input type="text" tabindex="-1" maxlength=50 placeholder="Email" class="website_holder" name="website" readonly>
                        <input type="email" maxlength=40 placeholder="Email" class="email_holder" name="email">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="text-leave">
                        <textarea class="comment_holder" name="comment" placeholder="Add a Comment"></textarea>
                        <input type="submit" value="Post Comment" onclick="gtr('Send Comment')">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>