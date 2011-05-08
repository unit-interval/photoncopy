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
				 	$('div.footer > div.clear').append('123');
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
	setInterval(order_list_refresh, 30000);
});
