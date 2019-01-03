@extends ('site::template.master')
@section ('content')
<div class="pt-100  mobaddpadd">
	<div class="container">
		<div class="text-center pb-80">
			<h3>Our Clients</h3>
		</div>

		@foreach($lists->chunk(6) as $items)
		<div class="row">
			@foreach($items as $item)
			<div class="col-sm-4 col-md-3 col-lg-2">
				<div class="zoom-hover mb-50">
					<a href="{{ url()->route('front.project.detail', ['slug' => $item->slug]) }}">
						<img class="mb-20 lazy" data-src="{{ $item->getThumbnailUrl('image', 'small') }}" alt="{{ $item->title }}" >
						<h5 class="text-center mt-10 mb-20">{{ $item->title }}</h5>
					</a>
				</div>
			</div>
			@endforeach
		</div>
		@endforeach
	</div>
</div>
@stop