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

function showLightbox(content){
	$('body').css('overflow', 'hidden');
	$('div.lightbox').css('z-index', 500);
	$('div.lightbox').css('display', 'block');
	$('div.lightbox').html(content);
}

function hideLightbox(){
	$('body').css('overflow', '');
	$('div.lightbox').css('z-index', -500);
	$('div.lightbox').css('display', 'none');
	$('div.lightbox').html('');
}