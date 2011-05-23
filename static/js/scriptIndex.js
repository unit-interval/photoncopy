$(document).ready(function(){
	$('span.lightboxClose').click(function(){
		hideLightbox();
	})
	$("#loginBtn").click(function(){
		showLightbox('#login');
		$('span.lightboxClose').click(function(){
			hideLightbox();
		})
	});
	$("#signupBtn").click(function(){
		showLightbox('#signup');
	});
	$("#forgetBtn").click(function(){
		hideLightbox();
		showLightbox('#forget');
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
							addNotification(0, 'email successfully sent.')
						else if(data.errno == 4)
							addNotification(0, 'user already exists.')
					 },
			},
		});
	});
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
							addNotification(0, 'email successfully sent.')
						else if(data.errno == 4)
							addNotification(0, 'user doesn\'t exist.')
					 },
			},
		});
	});
})
