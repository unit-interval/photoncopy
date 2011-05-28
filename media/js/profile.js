function showPage(pageNo, duration){
	if (pageNo=='') pageNo='0';
	if ($('#profile-'+pageNo).css('display')=='none'){
		$('.profileR').fadeOut(duration);
		$('#profile-'+pageNo).delay(duration).fadeIn(duration);
		$('div.profileRWrapper').animate({'height': $('#profile-'+pageNo).css('height')});
	}
}

$(function(){
	showPage(location.hash.slice(1), 0);
	$('div.profileL > ul > li').click(function(){
		showPage($(this).data('hash'), 250);
	})
	$('table.statTable tr:even').addClass('alt');
})