var latest_oid = 0;

function order_bind_action_par(expand) {
	expand = expand || 0;
	$('#taskAccordion > div.newly_added')
		.removeClass('newly_added')
		.each(function(){
			if(expand != 0) {
				$('h3', this)
					.addClass('selected')
					.find('span').obFlash().end()
					.next().show();
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
								if(data.errno == 0) {
									$(div).replaceWith(data.html);
									order_bind_action_par(1);
								}
							},
					},
				});
			});
		})
		.find('h3').click(function(){
			$(this).toggleClass('selected')
				.next().slideToggle();
		}).end();

}

function order_list_fetch_new() {
	var $tbody = $('#taskAccordion');
	var first_id = $('div.taskItem:first', $tbody).data('id');
	var param = {};
	latest_oid = Math.max(first_id, latest_oid);
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
				}
		}
	})
}

$(function(){
	
	showLightbox("#lockMask");
	
	$('#msgChange').click(function(){
		$('#msgNew').val($('#msgBody').html());
		$('#msgChangePanel').slideDown(250);
	});
	$('#msgCancel').click(function(){
		$('#msgChangePanel').slideUp(250);
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

	order_bind_action_par();
	setInterval(order_list_fetch_new, 60000);
//
})
