$(function(){
	$("body").on("click", ".delete-button", function(e){
		e.preventDefault();
		delete_url = $(this).attr('href');
		delete_url = delete_url || $(this).attr('data-target');
		target = $(this).closest('.close-target');
		deletePrompt(delete_url, target);
	});

	//menu shown for pages
	$(".sidebar-menu li.active").parentsUntil('li').parent().addClass('active open').change();
	//menu shown for klorofil
	$("ul.sidebar-nav a.active").closest('.collapse').addClass('show');
	$("ul.sidebar-nav a.active").closest('.collapse').prev('a').addClass('active');

	//richtext management
	loadTinyMce();

	//slug management
	if($("[data-slug]").length){
		$("[data-slug]").each(function(){
			var target = $(this).attr('data-slug');
			$('body').on('keyup', "#input-"+target, function(){
				current = $(this).val();
				tch = $(this).attr('id').split('-');
				sisa = tch.splice(1);
				tg = sisa.join('-');
				$("[data-slug='"+tg+"']").val(convertToSlug(current));
			});
		});
	}

	//switchery init
	$('body').on('change', ".js-switch", function(){
		$.ajax({
			url : $(this).attr('data-ajax'),
			type : 'POST',
			dataType : 'json',
			data : {
				_token : window.CSRF_TOKEN,
				id : $(this).attr('data-id'),
				field : $(this).attr('name'),
				value : $(this).is(':checked') ? 1 : 0
			},
			error : function(resp){
				error_handling(resp);
			}
		});
	});

	//init select2
	$(".select2").select2();


	//tagsinput blur action
	$('input + .bootstrap-tagsinput input').on('blur', function() {
		$(this).closest('.bootstrap-tagsinput').prev('input').tagsinput('add', $(this).val());
		$(this).val('');
	});

	//datepicker
	$("[data-datepicker]").each(function(){
		$(this).datepicker({
			startView : 2,
			format : 'yyyy-mm-dd'
		});
	});

    //timepicker
    $('[data-timepicker]').timepicker({
        timeFormat: 'HH:mm',
        interval : 5,
        startTime: '06:00',
        dynamic: false,
        dropdown: false,
        scrollbar: true
    });
	


	//lang switcher
	$("body").on('click', '.btn-lang-switcher', function(){
		lang = $(this).attr('data-lang');
		reload = $(this).hasClass('reload');
		$.ajax({
			url : BASE_URL + '/lang/' + lang,
			type : 'POST',
			dataType : 'json',
			data : {
				_token : window.CSRF_TOKEN
			},
			success : function(resp){
				if(reload){
					location.reload();
				}
			}
		});
	});

});

function swal(type, messages){
	$("#alertModal .modal-header h5").html(type);
	out = '';
	$(messages).each(function(ky, msg){
		if(type == 'error'){
			type = 'danger';
		}
		out += '<div class="alert alert-'+type+' text-center">'+msg+'</div>';
	});
	$("#alertModal .alert-modal-content").html(out);
	$("#alertModal").modal();
}

//init slugify
function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-')
        ;
}

//init richtext
function loadTinyMce(){
	tinymce.init({
		selector : 'textarea[data-tinymce]',
		height : 400, 
		theme : 'modern',
		plugins : 'searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
		toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
		image_advtab: true,
//		images_upload_url : BASE_URL + '/api/store-images',

		images_upload_handler: function (blobInfo, success, failure) {
			var xhr, formData;

			xhr = new XMLHttpRequest();
			xhr.withCredentials = false;
			xhr.open('POST', BASE_URL + '/api/store-tinymce');
			xhr.setRequestHeader('X-CSRF-TOKEN', window.CSRF_TOKEN);

			xhr.onload = function() {
			  var json;
			  if (xhr.status != 200) {
			    failure('HTTP Error: ' + xhr.status);
			    return;
			  }
			  json = JSON.parse(xhr.responseText);
			  if (!json || typeof json.location != 'string') {
			    failure('Invalid JSON: ' + xhr.responseText);
			    return;
			  }
			  success(json.location);
			};

			formData = new FormData();
			formData.append('file', blobInfo.blob(), blobInfo.filename());

			xhr.send(formData);
		}

	});
}

function error_handling(resp){
	if(resp.errors){
		$.each(resp.errors, function(k, v){
			swal('Error', v[0], 'error');
		});
	}

	if(resp.responseJSON){ //kalo berbentuk xhr object, translate ke json dulu
		resp = resp.responseJSON;
	}

	if(resp.type && resp.message){
		swal('Error', resp.message, 'error');
	}
	else{
		swal('Server Error', 'Sorry, we cannot process your last request', 'error');
	}
}



function deletePrompt(url, removedDiv){
	swal({
	  title: "Are you sure?",
	  text: "Once deleted, you will not be able to recover the data.",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	  	ajaxUrlProcess(url, removedDiv);
	  }
	});
}

function ajaxUrlProcess(url, removedDiv, ajax_type){
	ajax_type = ajax_type || 'POST';

	$.ajax({
		url : url,
		type : ajax_type,
		dataType : 'json',
		data : {
			_token : window.CSRF_TOKEN
		},
		success : function(resp){
			if(resp.type == 'success'){
				swal('Success', resp.message, 'success');
				if(removedDiv != undefined){
					removedDiv.fadeOut(300);
					setTimeout(function(){
						removedDiv.remove();
					}, 300);
				}
				if(typeof tb_data != undefined){
					tb_data.ajax.reload();
				}
			}
			else if(resp.type == 'error'){
				swal('Error', resp.message, 'error');
			}
		},
		error : function(resp){
			error_handling(resp);
		}
	});
}

function defaultModal(title, content){
	title = title || '';
	content = content || '';

	$("#defaultModal .default-modal-title").html(title);
	$("#defaultModal .default-modal-content").html(content);
	$("#defaultModal").modal('show');
}