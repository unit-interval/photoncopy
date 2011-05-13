UP = {
	start: function(){
		this.id = makeid();
		$('#formFile input[name:UPLOAD_IDENTIFIER]').val(this.id);
		$('#formFile').submit();
		this.timer = setInterval(this.update, 1000);
//		show progress bar;
	},
	update: function(){
		$.ajax({
			type: 'get',
			data: 'id=' + this.id,
			url: '/xhr/upload-progress.php',
			cache: false,
			dataType: 'json',
			success: function(data){
				var result = $.parseJSON(data);
//				modify the progress bar
			},
		});
	},
	finish: function() {
//		do the proper things
	}
	stop: function() {
		clearInterval(this.timer);
	}

}
function makeid() {
    var id = '';
    var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < 5; i++ )
        id += possible.charAt(Math.floor(Math.random() * possible.length));
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
	param['status'] = $('input[name=status]', row).val();
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
	$('#formFile input[name:file]').change(function(){
		if($(this).val() != '')
			UP.start();
	});

//	setInterval(order_list_refresh, 30000);
});
