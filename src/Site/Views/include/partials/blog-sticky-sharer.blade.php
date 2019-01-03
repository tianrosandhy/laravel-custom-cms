<!-- sticky sharer -->
<div class="sticky-sharer">
    <a onclick="gtr('Post Comment')" href="#comment-section" class="sharer-item comment" sync>
        <i class="fa fa-comment"></i>
    </a>
    <a onclick="gtr('Post Like')" class="sharer-item liker {{ $config['is_liked'] ? 'is-liked' : '' }}" data-id="{{ $data->id }}" data-nonce="{{ encrypt($data->id) }}" sync>
        <span class="liker-handle">
            <i class="fa fa-heart"></i>
            <span class="counter">{{ isset($config['likes']) ? $config['likes'] : 0 }}</span>
            <span data-like>{{ $config['is_liked'] ? 'Unlike post' : 'Like this post' }}</span>
        </span>
    </a>
    
    <?php
    $url = url()->current();
    ?>
    <a onclick="gtr('Facebook Share')" href="https://www.facebook.com/sharer.php?u={{ $url }}" target="_blank" sync class="sharer-item facebook">
        <i class="fa fa-facebook"></i>
    </a>
    <a onclick="gtr('Twitter Share')" href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ $title }}&hashtags=tianrosandhy" sync class="sharer-item twitter" target="_blank">
        <i class="fa fa-twitter"></i>
    </a>
    <a onclick="gtr('Google Plus Share')" href="https://plus.google.com/share?url={{ $url }}&text={{ $title }}" target="_blank" sync class="sharer-item google-plus">
        <i class="fa fa-google-plus"></i>
    </a>
    <a onclick="gtr('Whatsapp Share')" href="whatsapp://send?text={{ $url }}" target="_blank" sync class="sharer-item whatsapp">
        <i class="fa fa-whatsapp"></i>
    </a>
</div>