function showPage(pageNo, duration){
	if (pageNo=='') pageNo='0';
	if ($('#profile-'+pageNo).css('display')=='none'){
		$('.profileR').fadeOut(duration);
		$('#profile-'+pageNo).delay(duration).fadeIn(duration);
	}
}

function showTaskDetail(taskNo){
	$('#taskDetail').html(taskContent[taskNo]);
	$('#taskDetail').slideDown(500);
}

$(function(){
	showPage(location.hash.slice(1), 0);
	$('div.profileL > ul > li').click(function(){
		showPage($(this).data('hash'), 100);
	})
})