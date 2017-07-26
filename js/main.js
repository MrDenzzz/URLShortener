$(function(){
	$("#custom_box").bind("click",function(){
		$("#custom_url").toggle("fast");
		$("#custom_sub").toggle("fast");
		$("#generate").toggle("fast");
	});
});

$(document).on('submit', '#url', function() {
	var form = $(this);
	var error = false;
	if ($('.full_url').val() == '') {
		alert('Зaпoлнитe пoлe "' + $('.full_url').attr('placeholder') + '"!');
		error = true;
	}
	if ($('#custom_url').val() == '' && $('#custom_box').prop('checked')) {
		alert('Зaпoлнитe пoлe "' + $('#custom_url').attr('placeholder') + '"!');
		error = true;
	}
	if (!error) {
		var data = form.serialize();		
		$.ajax({
			type: 'POST',
			url: 'http://' + window.location.hostname + '/ajax.php',
			data: data,
			beforeSend: function (data) {
				form.find('input[type="submit"]').attr('disabled', 'disabled');
			},
			success: function (data) {
				if (data['error']) {
					alert(data['error']);
				} else {
					$('.results').html(data);
				}
			},
			complete: function (data) {
				form.find('input[type="submit"]').attr('disabled', false);
			}
		});
	}
	return false;
});
