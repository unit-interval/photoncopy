var latest_oid = 0;

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
	setInterval(order_list_fetch_new, 10000);
});
