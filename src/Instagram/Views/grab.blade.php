@extends ('main::master')

@push ('style')
<style>
	form.ig-grab{
		position:relative;
		transition:.3s ease;
		-moz-transition:.3s ease;
		-webkit-transition:.3s ease;
		-o-transition:.3s ease;
		-ms-transition:.3s ease;
	}

	form.ig-grab.progressing{
		opacity:.5;
	}

	form.ig-grab.progressing::after{
		content:'';
		display:block;
		position:absolute;
		top:0;
		left:0;
		width:100%;
		height:100%;
	}


	.loader{
		position:fixed;
		top:0;
		left:0;
		width:100%;
		height:100%;
		background:#fff;
		opacity:.75;
		z-index: 10;
	}
</style>
@endpush

@section ('content')
	<div class="loader" style="display:none"></div>
	<h3>{{ $title }}</h3>

	<a href="{{ url()->route('admin.instagram.index') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>

	<form action="" method="post" class="ig-grab">
		<input type="hidden" name="nextId" id="nextId">
		{{ csrf_field() }}
		<div class="panel panel-body">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Filter By</label>
						<select name="filter_by" id="filter_by" class="form-control">
							<option value="tag">Tag</option>
							<option value="username">Username</option>
						</select>
					</div>
					
				</div>
				<div class="col-sm-6">
					<div class="form-group" data-filter="tag">
						<label>Tag</label>
						<input type="text" name="tag" class="form-control">
					</div>

					<div class="form-group" data-filter="username">
						<label>Username</label>
						<input type="text" name="username" class="form-control">
					</div>
					
				</div>
			</div>

			<div align="center" class="padd">
				<button class="btn btn-primary">Grab By This Filter</button>
			</div>

		</div>

		<div id="grab-content"></div>

	</form>


@stop


@push ('script')
<script>
$(function(){
	manageGrabForm();
	function manageGrabForm(){
		grabbed = $("#filter_by").val();

		$(".form-group[data-filter]").slideUp();
		$(".form-group[data-filter='"+grabbed+"']").slideDown();
	}

	$("#filter_by").on('change', function(){
		manageGrabForm();
	});

	$(document).on('click', ".btn-ctrlpage", function(){
		$('#nextId').val($(this).attr('value'));
		data = $('form.ig-grab').serialize();
		currentScrollPosition = $(window).scrollTop();
		$(".loader").fadeIn();
		$.ajax({
			url : '{{ url()->route('admin.instagram.loadmore') }}',
			type : 'POST',
			dataType : 'json',
			data : data,
			success : function(resp){
				$("#grab-content .ig-content").append(resp.view);
				$('html, body').animate({
					scrollTop : currentScrollPosition
				});

				respMaxId = resp.data.maxId;
				if(respMaxId == null){
					$(".btn-ctrlpage").fadeOut();
				}
				else{
					$('.btn-ctrlpage').attr('value', respMaxId);
				}
				$(".loader").fadeOut();
			},
			error : function(resp){
				$(".loader").fadeOut();
			}
		});
	});


	$(document).on('submit', "form.ig-grab", function(e){
		e.preventDefault();
		grabForm = $(this);
		grabForm.addClass('progressing');

		$(".loader").fadeIn();

		$.ajax({
			type : 'POST',
			dataType : 'html',
			data : $(this).serialize(),
			success : function(resp){
				$("#grab-content").html(resp);
				grabForm.removeClass('progressing');
				$(".loader").fadeOut();
			},
			error : function(resp){
				grabForm.removeClass('progressing');
				$(".loader").fadeOut();
			}
		});
	});


	$(document).on('click', '.btn-import', function(e){
		e.preventDefault();
		target = $(this).attr('href');
		$(".loader").fadeIn();
		$.ajax({
			url : target,
			dataType : 'json',
			success : function(resp){
				swal(resp.type, resp.message, resp.type);
				$(".loader").fadeOut();
				if(resp.type == 'success'){
					$(".btn-import[href='"+target+"']").remove();
				}
			},
			error : function(resp){
				$(".loader").fadeOut();
			}
		});
	});
});
</script>
@endpush