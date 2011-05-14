var UP = {
	start: function(fn){
//		check former upload.
		this.filename = fn;
		this.id = makeid();
		$('#formFile input[name="UPLOAD_IDENTIFIER"]').val(this.id);
		var $bar = $('#status');
		$('span', $bar).html(basename(this.filename).substr(0,30));
		$('div > div', $bar).width('0px');
		$bar.slideDown();
		$('#formFile').submit();
		this.timer = setInterval(this.update, 500);
	},
	update: function(){
		if(this.ajax === true) return;
		this.ajax = true;
		var t = this;
		$.ajax({
			type: 'get',
			data: 'id=' + this.id,
			url: '/xhr/upload-progress.php',
			cache: false,
//			dataType: 'json',
			success: function(data){
				t.ajax = false;
//				var result = $.parseJSON(data);
//				modify the progress bar
				$('body').append(data);
			},
		});
	},
	finish: function() {

	},
	stop: function() {
		clearInterval(this.timer);
	}

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
			UP.start($(this).val());
	});
	$('iframe[name="ifr_upload"]').load(function(){
		var c = $(this).contents();
		var r = $('#result', c);
		if(r.length > 0) {
			UP.stop();
			alert(r.text());
		}
	});

//	setInterval(order_list_refresh, 30000);
});
