var latest_oid = 0;

function order_binding_action() {
	var row = $('tr.newly_added');
	$('a', row).click(function(){
		var row = $(this).parent().parent();
		var param = new Object();
		param['oid'] = $('input[name="oid"]', row).val();
		param['act'] = $(this).next().val();
		$.ajax({
			type: "get",
			url: "/xhr/order-action-par.php",
			cache: false,
			data: param,
			dataType: 'html',
			statusCode: {
				204: function() {
						console.log('204');
					 },
				200: function(data){
						row.replaceWith(data);
						order_binding_action();
						console.log(data);
					}
			}
		});
	});
	row.removeClass('newly_added');
	console.log('called');
}

function order_list_fetch_new() {
	var tbody = $('#order_list');
	var first_id = $('tr:first > td:first', tbody).html();
	var param = new Object();
	param['since'] = Math.max(first_id, latest_oid);
	$.ajax({
		type: "get",
		url: "/xhr/order-fetch-new.php",
		cache: false,
		data: param,
		dataType: 'html',
		statusCode: {
			204: function() {
					console.log('204');
				 },
			200: function(data){
					tbody.prepend(data);
					console.log(data);
				}
		}
	})
}

$(function(){
	order_binding_action();
//	setInterval(order_list_fetch_new, 10000);
});
