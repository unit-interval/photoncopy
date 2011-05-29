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
							Notification.add('邮件已成功发送，请查收注册确认函');
						else if(data.errno == 3)
							Notification.add('邮箱已被注册，请直接登录');
						else if(data.errno == 1)
							Notification.add('邮箱输入有误，请重新输入');
						else
							Notification.add('啊哦，服务器开小差了，请稍候访问');
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
							Notification.add('邮件已成功发送，请查收重设密码邮件');
						else if(data.errno == 3)
							Notification.add('需要找回密码的邮箱尚未被注册');
						else if(data.errno == 1)
							Notification.add('邮箱输入有误，请重新输入');
						else
							Notification.add('啊哦，服务器开小差了，请稍候访问');
					 },
			},
		});
		return false;
	});
})
