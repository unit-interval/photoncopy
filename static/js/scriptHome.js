var page=[['1-10页', 1],['10-50页',10],['50-200页',50],['200-500页',200],['500-1000页',500], ['1000页以上',1000]];
var copy=[1,2,3,4,5,6,7,8,9,10,20,30,40,50,60,70,80,90,100,200,300,400,500,600,700,800,900,1000];

function refreshCredit(){
	var colorN;
	switch($('#w3Form2').val()){
		case '2': colorN=14.4;
		break;
		default: colorN=0.4;
	}
	var paperN=0.6;
	var doubleN;
	switch($('#w4Form').val()){
		case '2': doubleN=2;
		break;
		default: doubleN=1;
	}
	var pageN=page[$("div#dynos-slider").slider("value")][1];
	var copyN=parseInt($("span#copyNumber").html());
	var bindN;
	switch($('#w7Form').val()){
		case '4': bindN=15;
		break;
		default: bindN=0;
	}
	var layoutN;
	switch($('#w5Form').val()){
		case '2': layoutN=2;
		break;
		case '4': layoutN=4;
		break;
		case '6': layoutN=6;
		break;
		case '8': layoutN=8;
		break;
		case '9': layoutN=9;
		break;
		case '12': layoutN=12;
		break;
		default: layoutN=1
	}
	var credit0 = parseInt($('#credit0').html());
	var credit1 = credit0 - Math.round((paperN*Math.ceil(pageN/doubleN/layoutN)+colorN*Math.ceil(pageN/layoutN))*copyN+bindN);
	$('#credit1').html(Math.max(0, credit1));
}

$(function(){
	

	$('#btn1').hover(function(){
		$('#btn0').css('background-position-y', '-80px');
	}, function(){
		$('#btn0').css('background-position-y', '0px');
	});
	
	$('#btn1, #btn2, #btn3, #btn4, #btn5, #btn6, #btn7, #btn8').click(function(){
		var pastSelectedBtn = $('.innerBtn.selected', $(this).parent().parent());
		this.css('background-position-y');
		if (this != pastSelectedBtn){
			pastSelectedBtn.css('background-position-y','0px');
			pastSelectedBtn.animate({width: '121px'}, 'swing');
			this.css('background-position-y', '-80px');
			this.animate({width: '131px'}, 'swing');
		}
	});
	
	$('#credit').hover(function(){
		$('#btnWrapper').css('background-position-y', '-80px');
	}, function(){
		$('#btnWrapper').css('background-position-y', '0px');
	});
	
	$('table.hovertable td').hover(function(){
		$(this).siblings().eq(0).dequeue().fadeTo('normal', 1);
		$(this).parent().siblings().eq(0).children().eq($(this).index()).dequeue().fadeTo('normal', 1);
	}, function(){
		$(this).siblings().eq(0).dequeue().fadeTo('normal', 0.5);
		$(this).parent().siblings().eq(0).children().eq($(this).index()).dequeue().fadeTo('normal', 0.5);
	});
	
	$('div.w2item, .w3item, .w4item, .w5item, .w7item').click(function(){
		$('.'+$(this).attr('class')).removeClass('selected');
		$(this).addClass('selected');
	});
	
	// click on w2 item
	$('div.w2item').click(function(){
		$('#w2Form').val($('div.storeId', this).html());
		$('#w2Edit').html($('h2', this).html());
	});
	
	// click on w3 item
	$('div.w3item').click(function(){
		col=$(this).parent().index();
		colName=$(this).parent().parent().siblings().eq(0).children().eq(col).html();
		row=$(this).parent().parent().index();
		rowName=$(this).parent().siblings().eq(0).html();
		$('#w3Form1').val(col);
		$('#w3Form2').val(row);
		$('#w3Edit1').html(colName);
		$('#w3Edit2').html(rowName);
		refreshCredit();
	});
	
	// click on w4 item
	
	$('div.w4item').click(function(){
		var col=$(this).parent().index();
		var colName=$(this).parent().parent().siblings().eq(0).children().eq(col).html();
		$('#w4Form').val(col);
		$('#w4Edit').html(colName);
		refreshCredit();
	});
	
	// click on w5 item

	$('div.w5item').click(function(){
		var col=$(this).parent().index();
		var colName=$(this).parent().parent().siblings().eq(0).children().eq(col).html();
		$('#w5Form').val(col);
		$('#w5Edit').html(colName);
		refreshCredit();
	});
	
	// click on w6 plus and minus
	
	$('#copyP1').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())<1000){
			a.html(parseInt(a.html())+1);
			refreshCredit();
		}
	});

	$('#copyM1').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())>1){
			a.html(parseInt(a.html())-1);
			refreshCredit();
		}
	});

	$('#copyP10').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())<991){
			a.html(parseInt(a.html())+10);
			refreshCredit();
		}
	});

	$('#copyM10').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())>10){
			a.html(parseInt(a.html())-10);
			refreshCredit();
		}
	});
	
	// click w6 confirm btn
	
	$('#w6ConfirmBtn').click(function(){
		var pageNumber=$("div#dynos-slider").slider('value');
		var copyNumber=parseInt($("span#copyNumber").html());
		$('#w6Form1').val(pageNumber);
		$('#w6Edit1').html(page[pageNumber][0]);
		$('#w6Form2').val(copyNumber);
		$('#w6Edit2').html(copyNumber+'份')
	});
	
	// click on w7 item
	
	$('div.w7item').click(function(){
		var col=$(this).parent().index();
		var colName=$(this).parent().parent().siblings().eq(0).children().eq(col).html();
		$('#w7Form').val(col);
		$('#w7Edit').html(colName);
		refreshCredit();
	});
	
	// click on w8 item
	$('#w8ConfirmBtn').click(function(){
		$('#w8Form').val($('#w8Edit').val());
		$('#guarantee').val(parseInt($('#credit0').html())-parseInt($('#credit1').html()));
		$('form').submit();
	});
				
	var _slider=$("div#dynos-slider").slider({
		animate: 'true',
		orientation: "vertical",
		min: 0,
		max: 5,
		value: 0,
		slide: function(event, ui){
			var tmpValue=page[ui.value];
			$('span#dynos-handle-inner-dynos').html(tmpValue[0]);
			refreshCredit();
		}
	});
	
	_slider.find('a').html(
	'<span id="dynos-handle-inner"><span id="dynos-handle-inner-dynos">1-10页</span></span>'
	)
	
	_slider = $("#workers-slider").slider({
		animate: 'true',
		orientation: "vertical",
		min: 0,
		max: 27,
		value: 0,
		slide: function(event, ui){
			$("span#copyNumber").html(copy[ui.value]);
			refreshCredit();
		}
	});
	
	_slider.find("a").html(
	'<span id="workers-handle-inner"><span id="workers-handle-inner-workers"><span id="copyNumber">1</span>份</span><span id="workers-handle-inner-price"></span></span>'
	);
		
})
