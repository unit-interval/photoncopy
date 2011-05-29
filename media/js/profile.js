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
		showPage($(this).find('a').attr('href').slice(1), 250);
	})
	$('table.statTable tr:even').addClass('alt');
	$('#profile-1-2 form').submit(function(){
		if ($('#pass1').val() != $('#pass2').val() || $('#pass1').val() == '') return false;
	})
	$('#profile-1-1 form').submit(function(){
		ob=$('#user_login');
		if (ob.val() == '' || ob.val() == ob.attr('title')) return false;
	})
	$('#profile-0 form').submit(function(){
		if ($('#user_login').val() == '' || $('#pass1').val() != $('#pass2').val() || $('#pass1').val() == '') return false;
	})
})