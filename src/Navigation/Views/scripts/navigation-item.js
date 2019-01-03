$(function(){
	$(".nav-nestable").each(function(){
		$(this).nestable({
			maxDepth : 3
		}).on('change', function(){
			serializeGroup($(this).attr('data-group'));
		});
		serializeGroup($(this).attr('data-group'), true);
	});


	$("body").on('click', '.add-navigation, .btn-update-menu', function(e){
		e.preventDefault();
		$.ajax({
			url : $(this).attr('href'),
			type : 'POST',
			dataType : 'html',
			data : {
				_token : window.CSRF_TOKEN
			},
			success : function(resp){
				defaultModal('Add New Navigation Data', resp);
				navFormSwitcher();
			},
			error : function(resp){
				error_handling(resp);
			}
		});
	});


	$("body").on('change', '.select-menu-type', navFormSwitcher);




	$("body").on('submit', '.navigation-form', function(e){
		e.preventDefault();
		data = $(this).serialize();
		$.ajax({
			type : 'POST',
			dataType : 'json',
			data : data,
			success : function(resp){
				if(resp.type == 'error'){
					swal('Error', resp.message, 'error');
				}
				else if(resp.type == 'success'){
					window.location.reload();
				}
			}
		});
	});



	$("body").on('click', '.reorder-btn .btn', function(){
		group = $(this).attr('data-group');
		order_data = $('input[name="order-data"][data-group="'+group+'"]').val();
		instance = $(this).closest('.reorder-btn');
		$.ajax({
			url : $(this).attr('href'),
			type : 'POST',
			dataType : 'json',
			data : {
				_token : CSRF_TOKEN,
				group_id : group,
				order_data : order_data
			},
			success : function(resp){
				if(resp.type == 'success'){
					instance.slideUp();
					swal('Success', resp.message, 'success');
				}
				else{
					swal('Error', resp.message, 'error');
				}
			},
			error : function(resp){
				error_handling(resp);
			}
		});
	});

});


function navFormSwitcher(){
	cond = $(".select-menu-type").val();
	$("[data-target]").slideUp();
	$("[data-target='"+cond+"']").slideDown();
}


function serializeGroup(group_id, first_try){
	first_try = first_try || false;

	inputInstance = $("input[name='order-data'][data-group='"+group_id+"']");
	oldVal = inputInstance.val();

	json = $(".nav-nestable[data-group='"+group_id+"']").nestable('serialize');
	jsonData = window.JSON.stringify(json);
	inputInstance.val(jsonData);

	if(!first_try){
		if(oldVal != jsonData){
			//ada perubahan order, munculkan tombol show reorder button
			$(".reorder-btn[data-group='"+group_id+"']").slideDown();
		}
	}
}