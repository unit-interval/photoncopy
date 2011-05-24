var taskContent=[
	"",
	"<h2>献计献策</h2><p>意见如被采用，我们将授予金质徽章以表彰您对光子复制作出的杰出贡献。</p><p>请您留下您的宝贵意见：</p><form><textarea name='suggestion' rows='10'></textarea><input class='uiBtn3' type='submit' value='提交' /></form>",
	"<h2>大学校</h2><p>认证大学邮箱，获取更高信用。</p><p>邮箱名通常为学号，请登录网关查看邮箱中的验证码，将其复制到验证码区域完成认证。</p><table class='formTable'><tbody><tr><th>教育邮箱</th><td><input type='text' class='uiText2' name='email'/> @ <select class='uiSelect' name='university'><option value='@pku.edu.cn'>pku.edu.cn (北京大学)</option></select></td></tr><tr><th></th><td><input type='button' class='uiBtn3' value='获取验证码'/></td></tr><tr><th>验证码</th><td><input type='text' class='uiText2' name='email'/></td></tr><tr><th></th><td><input type='button' class='uiBtn3' value='验证教育邮箱'/></td></tr></tbody></table>"
]


function showPage(page){
	if (page=='') page='#1';
	var pageNo=page[1];
	$('.profileR').fadeOut(250);
	var pageDict=['','#accountSetting', '#taskCenter', '#creditCenter'];
	$(pageDict[pageNo]).delay(250).fadeIn(250);
}

function showTaskDetail(taskNo){
	$('#taskDetail').html(taskContent[taskNo]);
	$('#taskDetail').slideDown(500);
}

$(function(){
	$('div.badge', $('div#taskCenter')).click(function(){
		var selectedBadge = $('div.badge.selected', $('#taskCenter'));
		var clickBadge = $(this);
		if ($('input[name="taskNo"]', selectedBadge).val() == $('input[name="taskNo"]', clickBadge).val()){
			$('#taskDetail').slideUp(500);
			clickBadge.removeClass('selected');
		}
		else{
			if (selectedBadge!=[]) $('#taskDetail').slideUp(500, function(){
				showTaskDetail($('input[name="taskNo"]', clickBadge).val());
			});
			else showTaskDetail($('input[name="taskNo"]', clickBadge).val());
			selectedBadge.removeClass('selected');
			$(this).addClass('selected');
		}
	})
	
	showPage(location.hash);
	
	$('div.profileL a').click(function(){
		showPage($(this).attr('href'));
	})
})