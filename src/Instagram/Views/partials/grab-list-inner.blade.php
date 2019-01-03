@if(isset($data['medias']))
	@foreach($data['medias'] as $media)
		<tr>
			<td><img src="{{ $media->getImageThumbnailUrl() }}" height="100"></td>
			<td><a href="{{ $media->getLink() }}" target="_blank">{{ $media->getLink() }}</a></td>
			<td>{{ $media->getType() }}</td>
			<td>{{ $media->getCaption() }}</td>
			<td>{{ $media->getLikesCount() }} <i class="fa fa-heart"></i></td>
			<td>{{ date('d F Y H:i:s', intval($media->getCreatedTime())) }}</td>
			<td>
				<a href="{{ url()->route('admin.instagram.import', ['id' => $media->getId()]) }}" class="btn btn-primary btn-import">Import to Site</a>
			</td>
		</tr>
	@endforeach
@endif