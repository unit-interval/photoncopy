var latest_oid = 0;

function refresh_filter() {
	var a = new Array();
	var b = 0;
	for (var i = 0; i < 6; i++) {
		a[i] = $('span.taskStatus'+i).length;
		b += a[i];
	}
	$('#orderFilter > div').each(function(){
		if ($(this).data('status') == 'all') $('span', this).html(b);
		else $('span', this).html(a[$(this).data('status')]);
	})
}

function show_filtered_order(s) {
	if (s == 'all') $('div.taskItem', $('#taskAccordion')).show(250);
	else $('div.taskItem', $('#taskAccordion')).each(function() {
		if ($('span.taskStatus', this).hasClass('taskStatus'+s)) $(this).show(250);
		else $(this).hide(250);
	});
}

function minimize_store_status(d) {
	if ($('#minimizePanel').html() == '+') $('#minimizePanel').html('－');
	else $('#minimizePanel').html('+');
	$('#storeStatus').slideToggle(d);
	$('#minimizePanel').parent().toggleClass('lbCorner').toggleClass('rbCorner');
}

function order_bind_action_par(expand) {
	expand = expand || 0;
	$('#taskAccordion > div.newly_added')
		.removeClass('newly_added')
		.each(function(){
			if(expand != 0) {
				$('h3', this)
					.addClass('selected')
					.find('span').obFlash().end()
					.next().slideDown(500);
			}
			var div = this;
			var param = {};
			param.oid = $('div.taskDetail', this).data('id');
			$('input:button', this).click(function(){
				param.to = $(this).data('to');
				if($(this).data('form') == 1) {
					$('input:text', div).each(function(){
						param[$(this).attr('name')] = $(this).val();
					});
				}
				for(var i in param)
					if (! param[i])		// may need further validations
						return;
				$.ajax({
					type: "post",
					url: "/xhr/order-action-par.php",
					cache: false,
					data: param,
					dataType: 'json',
					statusCode: {
						200: function(data){
							switch (data.errno){
								case 4:
									Notification.add('订单状态已改变，请重新核查订单详情');
								case 0:
									$(div).slideUp(500, function(){
										$(div).replaceWith(data.html);
										order_bind_action_par(1);
										refresh_filter();
									})
									break;
								case 5:
									Notification.add('啊哦，服务器开小差了，请稍候再试');
									break;
								default:
									window.location.reload();
							}
						},
					},
				});
			});
		})
		.find('h3').click(function(){
			$(this).parent().siblings('div.taskItem').find('h3.selected').each(function(){
				$(this).removeClass('selected').next().slideUp(500);
			});
			$(this).toggleClass('selected')
				.next().slideToggle(500);
		}).end();

}

function order_list_fetch_new() {
	var $tbody = $('#taskAccordion');
	var first_id = $('div.taskItem:first', $tbody).data('id');
	var param = {};
	latest_oid = Math.max(first_id, latest_oid) || 0;
	param['since'] = latest_oid;
	$.ajax({
		type: "get",
		url: "/xhr/order-fetch-new.php",
		cache: false,
		data: param,
		dataType: 'html',
		statusCode: {
			200: function(data){
					$tbody.prepend(data);
					order_bind_action_par();
					refresh_filter();
					Notification.playsound();
				}
		}
	})
}

$(function(){
	
	showLightbox("#lockMask");
	
	$('#msgChange').click(function(){
//		$('#msgNew').val($('#msgBody').html());
		$('#msgChangePanel').slideDown();
	});
	$('#msgCancel').click(function(){
		$('#msgChangePanel').slideUp();
	});
	
	$('#storeLock').click(function(){
		showLightbox("#lockMask");
	})
	
	$('#lockMask input[name="phrase"]').keyup(function(){
		if($(this).val() == $(this).next().val()){
			$(this).val('');
			hideLightbox();
		}
	});
	
	$('input#taskSearch').keyup(function(){
		if ($('input#taskSearch').val()==''){
			$('div.taskItem', $('#taskAccordion')).show(250);
		}
		else{
			var key=$('input#taskSearch').val();
			$('div.taskItem', $('#taskAccordion')).each(function(){
				var str=$('h3', this).text();
				if (str.search(key)==-1) $(this).hide(250);
				else $(this).show(250);
			});
		}
	});
		
	// minimize the msg panel
	$('#minimizePanel').click(function() {
		minimize_store_status(500);
	});
	
	$('#orderFilter > div').click(function() {
		refresh_filter();
		show_filtered_order($(this).data('status'));
	});

	minimize_store_status(0);
	refresh_filter();
	order_bind_action_par();
	setInterval(order_list_fetch_new, 60000);
})
