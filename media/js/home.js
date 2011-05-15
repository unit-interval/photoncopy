var UP = {
	start: function(){
//		check former upload.
		this.filename = $('#formFile input[name="file"]').val();
		this.id = makeid();
//		this.last_response = [];
		$('#formFile input[name="UPLOAD_IDENTIFIER"]').val(this.id);
		var $bar = $('#status');
		$('span:first', $bar).html(basename(this.filename).substr(0,30));
		$('div > div', $bar).width('0px');
		$bar.slideDown();
		$('#formFile').submit();
		var t = this;
		this.timer = setInterval(function(){
			t.update();
		}, 500);
	},
	update: function(){
		var t = this;
		if(t.ajax === true) return;
		t.ajax = true;
		$.ajax({
			type: 'get',
			data: 'id=' + t.id,
			url: '/xhr/upload-progress.php',
			cache: false,
			dataType: 'json',
			success: function(data){
				t.ajax = false;
//				var result = $.parseJSON(data);
				if(data.id == 0) return;
				$('#status > div > div').width(data.percentage + 'px');
//				t.last_response.push(data);
			},
		});
	},
	stop: function() {
		clearInterval(this.timer);
	},
	fail: function() {
		$('#status span:last').html('上傳失敗.');
	},
	success: function(html) {
		var size = $('#upload-size', html).text();
		var name = $('#upload-name', html).text();
		$('#status > div > div').width('200px');
		$('#status span:last').html('上傳完成 (' + size + ')');
		$('#formOrder input[name="fid"]').val(this.id);
		$('#formOrder input[name="fname"]').val(name);
		$('#w8ConfirmBtn').removeAttr('disabled').val('提交');
	},

}
function basename(path) {
	return path.replace(/\\/g, '/').replace(/.*\//, '');
}
function makeid() {
    var id = '';
    var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < 8; i++ )
        id += charset.charAt(Math.floor(Math.random() * charset.length));
    return id;
}
function order_form_reset() {
	$('#w8').hide();
	$('#status, div.wDummy').slideUp();
}
function order_list_refresh() {
	$('tr.order_open').each(function() {
		order_status(this);
	});
}
function order_status(row) {
	var param = new Object();
	param['oid'] = $('td:first', row).html();
	param['status'] = $('input[name="status"]', row).val();
	console.log(param);
	$.ajax({
		type: "get",
		url: "/xhr/order-unit-status.php",
		cache: false,
		data: param,
		dataType: 'html',
		statusCode: {
			204: function() {
					console.log('204');
				 },
			200: function(data){
					$(row).replaceWith(data);
					console.log(data);
				}
		}
	});
}
function order_submit() {
	$.ajax({
		type: "post",
		url: "/xhr/order-submit.php",
		cache: false,
		data: $('#formOrder').serialize(),
		dataType: 'json',
		statusCode: {
			400: function() {
					console.log('400');
				 },
			403: function() {
					console.log('403');
				 },
			200: function(data){
					if(data.errno == 0) {
						$('#taskAccordion').prepend(data.html);
						order_bind_action();
						order_form_reset();
					}
				}
		}
	});
//	loading animation.
}

$(function(){
	$('#formFile input[name="file"]').change(function(){
		if($(this).val() != '')
			UP.start();
	});
	$('iframe[name="ifr_upload"]').load(function(){
		if(UP.id === undefined) return;
		UP.stop();
		var c = $(this).contents();
		var r = $('#upload-result', c);
		if(r.length == 0 || r.text() != 'success')
			UP.fail();
		else
			UP.success(c);
	});

//	setInterval(order_list_refresh, 30000);
});
