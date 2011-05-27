$(document).ready(function(){
	
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

	$('h3', 'div.taskItem').click(function(){
		$(this).toggleClass('selected')
			.next().slideToggle();
	});
	
	$('span.msgClose').click(function(){
		$(this).parent().hide(250);
		$('span#unread').html(parseInt($('span#unread').html())-1);
	});
	
	$('div#msgClearAll').click(function(){
		$('ul.unreadContent li').hide(500);
		$('span#unread').html(0);
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
})
