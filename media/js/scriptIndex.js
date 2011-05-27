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
	$('#signup input[type="submit"]').parents('form').submit(function(){
//		TODO validate email
		hideLightbox();
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
						else if(data.errno == 3)
							Notification.add('user already exists.');
						else if(data.errno == 1)
							Notification.add('invalid input.');
						else
							Notification.add('Ooops.');
					 },
			},
		});
		return false;
	});

	$('#forget input[type="submit"]').parents('form').submit(function(){
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
						else if(data.errno == 3)
							Notification.add('user doesn\'t exist.');
						else if(data.errno == 1)
							Notification.add('invalid input.');
						else
							Notification.add('Ooops.');
					 },
			},
		});
		return false;
	});
})
