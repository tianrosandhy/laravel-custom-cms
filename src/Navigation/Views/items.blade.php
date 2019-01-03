@extends ('main::master')

@push ('style')
<link rel="stylesheet" href="{{ admin_asset('assets/plugins/jquery-nestable/jquery.nestable.min.css') }}">
<style>
	.navigation-example{
		padding:1em;
	}
	.navigation-example::after{
		content:'';
		display:block;
		position:relative;
		clear:both;
	}

	.navigation-example ul{
		display:block;
		list-style:none;
		margin:0; 
		padding:0;
	}
	
	.navigation-example ul li, .navigation-example ul a{
		display:block;
		white-space:nowrap;
	}

	.navigation-example>ul>li{
		float:left;
		position:relative;
		margin-right:5px;
	}
	.navigation-example ul>li>a{
		background:#ddd;
		padding:.5em;
		color:#000;
		text-transform:uppercase;
	}

	.navigation-example ul>li>ul{
		position:absolute;
		left:0;
		padding-top:5px;
	}

	.navigation-example ul>li>ul>li>ul{
		left:100%;
		top:0;
	}

	.navigation-example ul ul{
		display:none;
	}

	.navigation-example ul>li:hover>ul{
		display:block;
	}

	.navigation-example>ul>li>a{
		background:#222;
		color:#fff;
	}


</style>
@endpush

@section ('content')
<h3>Navigation Items Management</h3>

@if($navigation->count() == 0)
<div class="alert alert-danger">
	Please create at least 1 navigation group first. <a href="{{ url()->route('admin.navigation.store') }}" class="btn btn-danger">Click here to create new nav group</a>
</div>
@endif

@foreach($navigation as $group)
	<div class="panel panel-default">
		<div class="panel-body">

			<h5><a href="{{ url()->route('admin.navigation.item.create', ['group' => $group->id]) }}" class="btn btn-primary btn-sm add-navigation"><i class="fa fa-plus"></i></a> {{ $group->group_name }}</h5>

	        <div class="dd nav-nestable" data-group="{{ $group->id }}">
	            <ol class="dd-list">
	            	@foreach($group->lists->where('parent', 0)->sortBy('sort_no') as $list)
	                <li class="dd-item dd3-item close-target" data-id="{{ $list->id }}">
	                    <div class="dd-handle dd3-handle"></div><div class="dd3-content">
	                    	{{ $list->title }}
	                    	<div class="ctrl-holder">
		                    	<a href="{{ url()->route('admin.navigation.item.create', ['group' => $group->id, 'item' => $list->id]) }}" class="btn btn-sm btn-info btn-update-menu"><i class="fa fa-pencil"></i></a>
		                    	<a href="{{ url()->route('admin.navigation.item.delete', ['id' => $list->id]) }}" class="btn btn-sm btn-danger delete-button"><i class="fa fa-trash"></i></a>
	                    	</div>
	                    </div>
	                    @if($group->lists->where('parent', $list->id)->count() > 0)
	                    <ol class="dd-list">
		                    @foreach($group->lists->where('parent', $list->id)->sortBy('sort_no') as $sublist)
	                        <li class="dd-item dd3-item close-target" data-id="{{ $sublist->id }}">
	                            <div class="dd-handle dd3-handle"></div><div class="dd3-content">
	                            	{{ $sublist->title }}
			                    	<div class="ctrl-holder">
				                    	<a href="{{ url()->route('admin.navigation.item.create', ['group' => $group->id, 'item' => $sublist->id]) }}" class="btn btn-sm btn-info btn-update-menu"><i class="fa fa-pencil"></i></a>
				                    	<a href="{{ url()->route('admin.navigation.item.delete', ['id' => $sublist->id]) }}" class="btn btn-sm btn-danger delete-button"><i class="fa fa-trash"></i></a>
			                    	</div>
	                            </div>
	                            @if($group->lists->where('parent', $sublist->id)->count() > 0)
			                    <ol class="dd-list">
				                    @foreach($group->lists->where('parent', $sublist->id)->sortBy('sort_no') as $lastlist)
			                        <li class="dd-item dd3-item close-target" data-id="{{ $lastlist->id }}">
			                            <div class="dd-handle dd3-handle"></div><div class="dd3-content">
			                            	{{ $lastlist->title }}
					                    	<div class="ctrl-holder">
						                    	<a href="{{ url()->route('admin.navigation.item.create', ['group' => $group->id, 'item' => $lastlist->id]) }}" class="btn btn-sm btn-info btn-update-menu"><i class="fa fa-pencil"></i></a>
						                    	<a href="{{ url()->route('admin.navigation.item.delete', ['id' => $lastlist->id]) }}" class="btn btn-sm btn-danger delete-button"><i class="fa fa-trash"></i></a>
					                    	</div>
			                            </div>
			                        </li>
				                    @endforeach
				                </ol>

	                            @endif
	                        </li>
		                    @endforeach
		                </ol>
	                    @endif
	                </li>
	                @endforeach
	            </ol>
	        </div>
	        <input type="hidden" readonly name="order-data" data-group="{{ $group->id }}">

	        <div class="padd reorder-btn" style="display:none;" data-group="{{ $group->id }}">
	        	<div href="{{ url()->route('admin.navigation.item.reorder') }}" data-group="{{ $group->id }}" class="btn btn-primary">Save Order Data</div>
	        </div>
			
		</div>

		<div class="navigation-example">
			<h5><mark>{{ $group->group_name }}</mark> Generated Example</h5>
			@include ('navigation::partials.example')
		</div>

	</div>
@endforeach

@stop

@push ('script')
	<script src="{{ admin_asset('assets/plugins/jquery-nestable/jquery.nestable.min.js') }}"></script>
	<script src="{{ asset('maxsol/js/scripts/navigation-item.js') }}"></script>
@endpush
