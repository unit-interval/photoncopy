$(document).ready(function(){

	$("#toggleMap").toggle(function(){
		$("#storeMap").slideDown();
		$(this).html('隐藏地图');
	},function(){
		$("#storeMap").slideUp();
		$(this).html('显示地图');
	});

//--------------------store javascript--------------------

	$('.storeItem').click(function(){
		$('input[name="store"]').val($(this).children('input[name="pId"]').val());
		$('#storeBtn').val($(this).children('input[name="pName"]').val());
	});

//--------------------size javascript--------------------

	$('.sizeItem').click(function(){
		$('input[name="size"]').val($(this).children().val());
		$('#sizeBtn').val($(this).children().val());
	});

//--------------------color javascript--------------------

	$('.colorItem').click(function(){
		$('input[name="color"]').val($(this).children().val());
		$('#colorBtn').val($(this).children().val());
	});

//--------------------double javascript--------------------

	$('.doubleItem').click(function(){
		$('input[name="double"]').val($(this).children().val());
		$('#doubleBtn').val($(this).children().val());
	});

//--------------------page javascript--------------------

	$('.pageItem').click(function(){
		var a=$(this).children('input[name="upper"]').val();
		var b=$(this).children('input[name="lower"]').val();
		$('input[name="pageUpper"]').val();
		$('input[name="pageLower"]').val();
		$('#pageBtn').val('每份'+a+'-'+b+'页');
	});

//--------------------copy javascript--------------------

	$('.copyItem').click(function(){
		$('input[name="copy"]').val($(this).children().val());
		$('#copyBtn').val($(this).children().val());
	});

//--------------------storelist javascript--------------------

	$('.storeItem').click(function(){
		$('input[name="store"]').val($(this).children('input[name="pId"]').val());
		$('#storeBtn').val($(this).children('input[name="pName"]').val());
	});

//--------------------pdf javascript--------------------

	$('#pdfTask').mouseover(function(){
		$('.panel.taskType').css('background-position', '0px -80px');
	});
	$('#pdfTask').mouseout(function(){
		$('.panel.taskType').css('background-position', '0px 0px');
	});
	$('#pdfTask').click(function(){
		$('input[name="type"]').val('pdf');
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
	$('#wordTask').click(function(){
		$('input[name="type"]').val('word');
	});

//--------------------ppt javascript--------------------

	$('#pptTask').mouseover(function(){
		$('.panel.taskType').css('background-position', '0px -240px');
	});
	$('#pptTask').mouseout(function(){
		$('.panel.taskType').css('background-position', '0px 0px');
	});	
	$('#pptTask').click(function(){
		$('input[name="type"]').val('ppt');
	});

})
