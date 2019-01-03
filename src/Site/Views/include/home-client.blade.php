<div class="brand-logo-area pb-120" id="project">
  <div class="container">
    <div class="section-title text-center mb-40">
      <h2>Our Clients</h2>
    </div>

    <div class="brand-logo-pattern lazy" data-src="{{ asset('assets/img/pattern/pattern-4.png') }}">
      <div class="owl-carousel clients-slider">
        @foreach($project as $row)
        <div class="single-brand-logo">
            <a href="{{ url()->route('front.project.detail', ['slug' => $row->slug]) }}">
                <img class="lazy" data-src="{{ $row->getThumbnailUrl('image', 'small') }}" alt="{{ $row->title }}">
            </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>  