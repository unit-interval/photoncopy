function addNotification(id, content){
	var no=$('div.notification', $('#notificationWrapper')).length+1;
	$('#dummyNotification').slideDown('normal');
	$('#notificationWrapper').append("<div class='notification'><span class='notificationCount'>"+no+"</span><input type='hidden' name='notificationId' value='"+id+"'/>"+content+"<span class='notificationClose'>×</span></div>");
	$('div.notification:last', $('#notificationWrapper')).fadeIn('normal');
	$('span.notificationClose', $('#notificationWrapper')).click(function(){
		removeNotification($(this).parent());
	});
}

function removeNotification(note){
	note.fadeOut('normal', function(){
		note.remove();
		if ($('div.notification', $('#notificationWrapper')).length==0) $('#dummyNotification').slideUp('normal'); 
	});
}

function showLightbox(id){
	$('div.lightbox > div[id!="dummyLightbox"]').hide();
	$('div.lightbox').show();
	$(id, 'div.lightbox').fadeIn(250);
	$(id, 'div.lightbox').addClass('inLightbox');
}

function hideLightbox(){
	$('div.lightbox .inLightbox').fadeOut(250, function(){
		$(this).removeClass('inLightbox');
		$('div.lightbox').hide();
	});
}

function objectFlash(id, times){
	times = times || 5;
	for (var i=0; i<times; i++) $(id).fadeTo(500, 0.2).fadeTo(500, 1);
}
