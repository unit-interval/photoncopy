$(document).ready(function(){
	
	$('#btn1').hover(function(){
		$('#btn0').css('background-position-y', '-80px');
	}, function(){
		$('#btn0').css('background-position-y', '0px');
	});
	
	$('#credit').hover(function(){
		$('#btnWrapper').css('background-position-y', '-80px');
	}, function(){
		$('#btnWrapper').css('background-position-y', '0px');
	});
	
	$('.hovertable td').hover(function(){
		$(this).siblings().eq(0).dequeue().fadeTo('normal', 1);
		$(this).parent().siblings().eq(0).children().eq($(this).index()).dequeue().fadeTo('normal', 1);
	}, function(){
		$(this).siblings().eq(0).dequeue().fadeTo('normal', 0.5);
		$(this).parent().siblings().eq(0).children().eq($(this).index()).dequeue().fadeTo('normal', 0.5);
	});
})