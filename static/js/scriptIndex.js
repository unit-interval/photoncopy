var loginContent=
	"<div id='login' class='panel'>"+
		"<h2>登录<span class='lightboxClose fright'>×</span></h2>"+
		"<form action='/authorize.php?c=login' method='post'>"+
			"<fieldset>"+
				"<div class='field'>"+
					"<label>邮箱</label>"+
					"<input type='text' name='email' placeholder='请输入邮箱地址' class='uiText' />"+
				"</div>"+
				"<div class='field'>"+
					"<label>密码<span id='forgetBtn' class='fright'>忘记密码</span></label>"+
					"<input type='password' name='passwd' placeholder='请输入密码' class='uiText'/>"+
				"</div>"+
			"</fieldset>"+
			"<fieldset class='submit'>"+
				'<input class="checkbox" type="checkbox" name="publicLogin" value="yes" /><h3> 正在使用公共电脑登录</h3>'+
				'<input class="uiBtn submit" type="submit" value="登录" />'+
			"</fieldset>"+
		"</form>"+
	"</div>";
		
var signupContent=
	"<div id='signup' class='panel'>"+
		"<h2>注册<span class='lightboxClose fright'>×</span></h2>"+
		"<form>"+
			"<fieldset>"+
				'<div class="field">'+
					'<label>邮箱</label>'+
					"<input type='text' name='email' placeholder='请输入邮箱地址' class='uiText'/>"+
				"</div>"+
			"</fieldset>"+
			"<fieldset class='submit'>"+
				'<input class="uiBtn submit" type="submit" value="注册" />'+
			"</fieldset>"+
		"</form>"+
	"</div>";

var forgetContent=
	"<div id='forget' class='panel'>"+
		"<h2>取回密码<span class='lightboxClose fright'>×</span></h2>"+
		"<form>"+
			"<fieldset>"+
				'<div class="field">'+
					"<label>邮箱</label>"+
					"<input type='text' name='email' placeholder='请输入邮箱地址' class='uiText' />"+
				"</div>"+
			"</fieldset>"+
			'<fieldset class="submit">'+
				'<input class="uiBtn submit" type="submit" value="取回密码" />'+
			"</fieldset>"+
		"</form>"+
	"</div>";

$(document).ready(function(){
	$("#loginBtn").click(function(){
		showLightbox(loginContent);
		$('span.lightboxClose').click(function(){
			hideLightbox();
		})
		$("#forgetBtn").click(function(){
			hideLightbox();
			showLightbox(forgetContent);
			$('span.lightboxClose').click(function(){
				hideLightbox();
			})
		})
	});
	$("#signupBtn").click(function(){
		showLightbox(signupContent);
		$('span.lightboxClose').click(function(){
			hideLightbox();
		})
	});
})
