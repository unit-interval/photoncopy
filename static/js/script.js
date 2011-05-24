function addNotification(id, content){
	$('#notification div.notificationContent:first').fadeOut('normal', function(){
		$('#notificationCount').html(parseInt($('#notificationCount').html())+1);
		$('#notification div.notificationContent:first').before($('#notification div.notificationContent:last').clone());
		$('#notification div.notificationContent:first').hide();
		$('#notification div.notificationContent:first span').html(content);
		$('#notification div.notificationContent:first input[type="hidden"]').val(id);
		$('#notification div.notificationContent').fadeIn('normal');
	})
	if ($('#notificationCount').html()=='1')
	{
		$('#dummyNotification').slideDown('normal');
		$('#notification').delay(250).fadeIn('normal');
	}
}

function removeNotification(){
	$('div#notification div.notificationContent:first').remove();
	$('#notificationCount').html(parseInt($('#notificationCount').html())-1);
	if ($('#notificationCount').html()=='0'){
		$('#dummyNotification').slideUp('normal');
		$('#notification').fadeOut('normal');
	}
}

function tryNotification(){
	$('#notificationCount').html($('div#notification div.notificationContent').length-1);
	$('#notificationClose').click(function(){
		removeNotification();
	})
	if ($('#notificationCount').html()!='0')
	{
		$('#dummyNotification').delay(500).slideDown('normal');
		$('#notification').delay(750).fadeIn('normal');
	}
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

$(function(){
	tryNotification();
})
