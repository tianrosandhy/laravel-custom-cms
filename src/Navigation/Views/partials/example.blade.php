<?php 
//cara panggil di FE juga nantinya persis sama seperti ini aja utk output data navigasi ke bentuk url absolute
$nav = Navigation::urlGenerate($group->group_name);
//kalau butuh data url mentah : Navigation::generate({group_name});
?>

<ul>
@foreach($nav as $label => $data)
	<li>
		<a href="{{ $data['url'] }}" {{ $data['new_tab'] == 1 ? 'target="_blank"' : '' }}>{{ $label }}</a>
		@if(isset($data['children']))
			<ul>
			@foreach($data['children'] as $sublabel => $subdata)
				<li>
					<a href="{{ $subdata['url'] }}" {{ $subdata['new_tab'] == 1 ? 'target="_blank"' : '' }}>{{ $sublabel }}</a>
					@if(isset($subdata['children']))
					<ul>
						@foreach($subdata['children'] as $lastlabel => $lastdata)
						<li><a href="{{ $lastdata['url'] }}">{{ $lastlabel }}</a></li>
						@endforeach
					</ul>
					@endif
				</li>
			@endforeach
			</ul>
		@endif
	</li>
@endforeach
</ul>