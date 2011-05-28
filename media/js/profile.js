function showPage(pageNo, duration){
	if (pageNo=='') pageNo='0';
	if ($('#profile-'+pageNo).css('display')=='none'){
		$('.profileR').fadeOut(duration);
		$('#profile-'+pageNo).delay(duration).fadeIn(duration);
	}
}

$(function(){
	showPage(location.hash.slice(1), 0);
	$('div.profileL > ul > li').click(function(){
		showPage($(this).data('hash'), 100);
	})
	$('table.statTable tr:even').addClass('alt');
	$('.storeNamePending').each(function(){
		$(this).html($(this).data('pid'));
	})
})