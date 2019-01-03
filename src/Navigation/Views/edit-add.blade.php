<form action="" method="post" class="navigation-form">
	{{ csrf_field() }}
	<input type="hidden" name="group_id" value="{{ $group_id }}">
	<input type="hidden" name="item_id" value="{{ $item_id }}">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<label>Menu Title</label>
				<input type="text" name="title" class="form-control" value="{{ isset($item->title) ? $item->title : '' }}">
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<label>Menu Type</label>
				<select name="type" class="form-control select-menu-type">
					<?php
					$selected = isset($item->type) ? $item->type : '';
					?>
					<option value="" {{ $selected == '' ? 'selected' : '' }}></option>
					<option value="url" {{ $selected == 'url' ? 'selected' : '' }}>URL</option>
					<option value="route" {{ $selected == 'route' ? 'selected' : '' }}>Route Name</option>
					<option value="post-category"  {{ $selected == 'post-category' ? 'selected' : '' }}>Post Category</option>
					<option value="post" {{ $selected == 'post' ? 'selected' : '' }}>Posts Data</option>
					<option value="page" {{ $selected == 'page' ? 'selected' : '' }}>Static Page</option>
				</select>
			</div>
		</div>

		<div class="col-sm-12" data-target="url">
			<div class="form-group">
				<label>Target URL</label>
				<input type="text" name="url" class="form-control" value="{{ isset($item->url) ? $item->url : '' }}">
			</div>
		</div>
		
		<div class="col-sm-12" data-target="route">
			<div class="form-group">
				<label>Target Route Name</label>
				<div class="row">
					<div class="col-sm-6">
						<input type="text" class="form-control" name="route" placeholder="Route Name" value="{{ isset($item->route) ? $item->route : '' }}">
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="parameter" placeholder="JSON Parameter (if needed)" value="{{ isset($item->parameter) ? $item->parameter : '' }}">
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-12" data-target="post-category">
			<div class="form-group">
				<label>Post Category</label>
				<select name="post_category" class="form-control">
					<?php $sele = isset($item->category_slug) ? $item->category_slug : ''; ?>
					@foreach($list['category'] as $rc)
						<option value="{{ $rc->slug }}" {{ $rc->slug == $sele ? 'selected' : '' }}>{{ $rc->name }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-sm-12" data-target="post">
			<div class="form-group">
				<label>Posts Data</label>
				<select name="posts" class="form-control">
					<?php $sele = isset($item->post_slug) ? $item->post_slug : ''; ?>
					@foreach($list['post'] as $rc)
					<option value="{{ $rc->slug }}" {{ $rc->slug == $sele ? 'selected' : '' }}>{{ $rc->title }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-sm-12" data-target="page">
			<div class="form-group">
				<label>Static Page</label>
				<select name="page" class="form-control">
					<?php $sele = isset($item->page_slug) ? $item->page_slug : ''; ?>
					@foreach($list['page'] as $rc)
					<option value="{{ $rc->slug }}" {{ $rc->slug == $sele ? 'selected' : '' }}>{{ $rc->title }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="form-group">
				<label>Font Icon Class</label>
				<input type="text" name="icon" class="form-control" value="{{ isset($item->icon) ? $item->icon : '' }}">
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label>Open in New Tab</label>
				<select name="new_tab" class="form-control">
					<?php
					$selected = isset($item->new_tab) ? $item->new_tab : 0;
					?>
					<option value="0" {{ $selected == 0 ? 'selected' : '' }}>No</option>
					<option value="1" {{ $selected == 1 ? 'selected' : '' }}>Yes</option>
				</select>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label>Menu Order Index</label>
				<input type="number" name="sort_no" class="form-control" value='{{ isset($item->sort_no) ? $item->sort_no : 0 }}' min=0>
			</div>
		</div>

		
		<div class="col-sm-12">
			<div class="form-group">
				<label>Parent</label>
				<select name="parent" class="form-control">
					<?php
					$selected = isset($item->parent) ? $item->parent : '';
					?>
					<option value="" {{ $selected == '' ? 'selected' : '' }}>- No Parent -</option>
					@foreach($parent_list as $parent)
						<option value="{{ $parent->id }}"  {{ $selected == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
					@endforeach
				</select>
			</div>
		</div>
	

	</div>

	<div class="padd">
		<button class="btn btn-primary">Save Menu Data</button>
	</div>
</form>