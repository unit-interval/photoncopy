var UP = {
	start: function(){
//		check former upload.
		this.filename = $('#formFile input[name="file"]').val();
		this.id = makeid();
		this.last_response = [];
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
				t.last_response.push(data);
			},
		});
	},
	stop: function() {
		clearInterval(this.timer);
	},
	fail: function() {
		$('#status').append('上傳失敗.');
	},
	success: function() {
		$('#status > div > div').width('200px');
		$('#status').append('上傳完成');
		$('#formOrder input[name="file-id"]').val(this.id);
	},

}
function basename(path) {
	return path.replace(/\\/g, '/').replace(/.*\//, '');
}
function makeid() {
    var id = '';
    var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < 5; i++ )
        id += charset.charAt(Math.floor(Math.random() * charset.length));
    return id;
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

$(function(){
	$('#formFile input[name="file"]').change(function(){
		if($(this).val() != '')
			UP.start();
	});
	$('iframe[name="ifr_upload"]').load(function(){
		if(UP.id === undefined) return;
		UP.stop();
		var c = $(this).contents();
		var r = $('#result', c);
		if(r.length == 0 || r.text() != 'success')
			UP.fail();
		else
			UP.success();
	});

//	setInterval(order_list_refresh, 30000);
});
