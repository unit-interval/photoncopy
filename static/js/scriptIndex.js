$(document).ready(function(){
	$("#loginBtn").click(function(){
		if ($("#login").css('display')=='block') $("#login").slideUp();
		else{
			if ($("#signup").css('display')=='block') $("#signup").slideUp(function(){$("#login").slideDown();});
			else if ($("#forget").css('display')=='block') $("#forget").slideUp(function(){$("#login").slideDown();});
			else $("#login").slideDown();
		}
	});
	$("#signupBtn").click(function(){
		if ($("#signup").css('display')=='block') $("#signup").slideUp();
		else{
			if ($("#login").css('display')=='block') $("#login").slideUp(function(){$("#signup").slideDown();});
			else if ($("#forget").css('display')=='block') $("#forget").slideUp(function(){$("#signup").slideDown();});
			else $("#signup").slideDown();
		}
	});
	$("#forgetBtn").click(function(){
		if ($("#forget").css('display')=='block') $("#forget").slideUp();
		else{
			if ($("#signup").css('display')=='block') $("#signup").slideUp(function(){$("#forget").slideDown();});
			else if ($("#login").css('display')=='block') $("#login").slideUp(function(){$("#forget").slideDown();});
			else $("#forget").slideDown();
		}
	})
})
