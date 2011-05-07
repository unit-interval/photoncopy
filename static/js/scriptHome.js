$(document).ready(function(){
	
//--------------------pdf javascript--------------------
	
	$('#pdfTask').mouseover(function(){
		$('.panel.taskType').css('background-position', '0px -80px');
	});
	$('#pdfTask').mouseout(function(){
		$('.panel.taskType').css('background-position', '0px 0px');
	});
	$('#pdfTask').click(function(){
	});

//--------------------word javascript--------------------

	$('#wordTask').mouseover(function(){
		$('.panel.taskType').css('background-position', '0px -160px');
	});
	$('#wordTask').mouseout(function(){
		$('.panel.taskType').css('background-position', '0px 0px');
	});	
	$('#wordTask').click(function(){
	});

//--------------------ppt javascript--------------------

	$('#pptTask').mouseover(function(){
		$('.panel.taskType').css('background-position', '0px -240px');
	});
	$('#pptTask').mouseout(function(){
		$('.panel.taskType').css('background-position', '0px 0px');
	});	
	$('#pptTask').click(function(){
	});

})
