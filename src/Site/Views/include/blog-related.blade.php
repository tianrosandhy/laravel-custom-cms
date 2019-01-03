<div class="related-blog-area border-bottom-4 pb-35 mb-50 mt-100">
    <h4 class="blog-details-title text-center">Recommended Articles</h4>
    <div class="row">
        <?php
        $n = 3;
        ?>
        @foreach($data->related as $rel)
            @if($rel->related->is_active == 1)
                <?php $n--; ?>
                @include ('site::include.partials.blog-related-item', [
                    'data' => $rel->related
                ])
            @endif
        @endforeach

        @if($n > 0)
        @foreach($random as $row)
            @if($n > 0)
                @include ('site::include.partials.blog-related-item', [
                    'data' => $row
                ])
            @endif
            <?php $n--; ?>
        @endforeach
        @endif
    </div>
</div>