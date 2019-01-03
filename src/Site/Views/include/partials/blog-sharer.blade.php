<div class="details-category-social">
    <div class="details-category">
        <?php
        $tags = explode(',',$data->tags);
        ?>
        <ul>
            @foreach($tags as $tg)
            <li><a href="{{ url()->route('front.search', ['keyword' => strtolower(trim($tg))]) }}">#{{ trim($tg) }}</a></li>
            @endforeach
        </ul>
    </div>
</div>