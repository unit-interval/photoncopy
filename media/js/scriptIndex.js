$(document).ready(function(){
	$('#dummyLightbox').click(function(){
		hideLightbox();
	});
	$('span.lightboxClose').click(function(){
		hideLightbox();
	})
	$("#loginBtn").click(function(){
		showLightbox('#login');
	});
	$("#signupBtn").click(function(){
		showLightbox('#signup');
	});
	$("#forgetBtn").click(function(){
		$('#login').removeClass('inLightbox').fadeOut(250, function(){
			showLightbox('#forget')
		});
	});
	$('#signup input[type="button"]').click(function(){
		hideLightbox();
//		TODO validate email
		$.ajax({
			type: "post",
			url: "/xhr/auth-signup.php",
			cache: false,
			data: $('#signup form').serialize(),
			dataType: 'json',
			statusCode: {
				200: function(data) {
						if(data.errno == 0)
							Notification.add('email successfully sent.');
						else if(data.errno == 4)
							Notification.add('user already exists.');
					 },
			},
		});
	});
	$('input[name="noteBtn"]').click(function(){
		Notification.add($('input[name="note"]').val());
	})
	$('#forget input[type="button"]').click(function(){
		hideLightbox();
//		TODO validate email
		$.ajax({
			type: "post",
			url: "/xhr/auth-forget.php",
			cache: false,
			data: $('#forget form').serialize(),
			dataType: 'json',
			statusCode: {
				200: function(data) {
						if(data.errno == 0)
							Notification.add('email successfully sent.');
						else if(data.errno == 4)
							Notification.add('user doesn\'t exist.');
					 },
			},
		});
	});
})