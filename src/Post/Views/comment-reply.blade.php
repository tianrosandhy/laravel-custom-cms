@extends ('main::master')
@section ('content')

<h3>{{ $title }}</h3>
<form action="" method="post">
	{{ csrf_field() }}

	<div class="well">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Post URL</label>
					<div><a href="{{ url()->route('front.post.detail', ['slug' => $data->post->slug]) }}">{{ $data->post->title }}</a></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Commented on</label>
					<div>{{ date('d F Y H:i:s', strtotime($data->created_at)) }}</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Email</label>
					<div>{{ $data->email }}</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Name</label>
					<div>{{ $data->last_name }}</div>
				</div>
			</div>
		</div>


		<div class="form-group">
			<label>Replied Comment</label>
			<textarea class="form-control" name="user_comment">{!! $data->message !!}</textarea>
		</div>
	</div>

	<div class="form-group">
		<label>Your Reply</label>
		<textarea name="reply" class="form-control"></textarea>
	</div>

	<div>
		<label>
			<input type="checkbox" name="with_email" value="1" checked>
			<span>Reply Comment With Email</span>
		</label>
	</div>

	<button class="btn btn-primary">Process</button>
</form>

@stop