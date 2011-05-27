function showPage(page){
	if (page=='') page='#1';
	var pageNo=page[1];
	$('.profileR').fadeOut(250);
	var pageDict=['','#accountSetting', '#creditCenter'];
	$(pageDict[pageNo]).delay(250).fadeIn(250);
}

function showTaskDetail(taskNo){
	$('#taskDetail').html(taskContent[taskNo]);
	$('#taskDetail').slideDown(500);
}

$(function(){
	showPage(location.hash);
	
	$('div.profileL a').click(function(){
		showPage($(this).attr('href'));
	})
})