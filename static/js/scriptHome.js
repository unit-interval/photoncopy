var page=[['1-10页', 1],['10-50页',10],['50-200页',50],['200-500页',200],['500-1000页',500], ['1000页以上',1000]];
var copy=[1,2,3,4,5,6,7,8,9,10,20,30,40,50,60,70,80,90,100,200,300,400,500,600,700,800,900,1000];

/* ---------- SHOW MORE ---------- */

function showMore(n){
	var formStatus=[
		true,
		($('#formFile input').val()!=''),
		($('#w2Form').val()!=''),
		($('#w3Form1').val()!='' && $('#w3Form2').val()!=''),
		($('#w4Form').val()!=''),
		($('#w5Form').val()!=''),
		($('#w6Form1').val()!='' && $('#w6Form2').val()!=''),
		($('#w7Form').val()!=''),
		false
	];
	var i;
	var j=0;
	toggleFocusBtn($('#btn'+n), 0, 0);
	wFade(btn2w($('#btn'+n)), 0, 0);
	for (i=n+1; i<formStatus.length; i++)
		if (formStatus[i]){
			if ($('#btn'+i).css('display')!='block') j++;
			$('#btn'+i).delay(250*j).show();
		}
		else break;
	toggleFocusBtn($('#btn'+i), 1, 250*(j+1));
	wFade(btn2w($('#btn'+i)), 1, 250*(j+1));
}

/* ---------- Btn Effect ---------- */

function toggleFocusBtn(ob, par, del){
	var defaultWidth=121;
	ob.parent().delay(del);
	defaultWidth+=10*par;
	ob.delay(del).css('display', 'block');
	ob.parent().animate({width: defaultWidth+'px'}, 250, 'swing');
	if (par) ob.delay(250).addClass('selected');
	else ob.removeClass('selected');
	if (ob.attr('id')=='btn1'){
		defaultWidth-=14;
		if (par) $('#btn0').addClass('selected');
		else $('#btn0').removeClass('selected');
	}
}

/* ---------- BTN TO W ---------- */

function btn2w(ob){
	var btnId=ob.attr('id');
	return $('#w'+btnId[btnId.length-1]);
}

/* ---------- W Effect ---------- */

function wFade(ob, par, del){
	ob.dequeue().delay(del).fadeTo(250, par);
	if (par==0) ob.css('display', 'none');
}

/* ---------- Credit Change ---------- */

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
	var pageN=parseInt($("span#pageNumber").html());
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
		case '3': layoutN=4;
		break;
		case '4': layoutN=6;
		break;
		case '5': layoutN=8;
		break;
		case '6': layoutN=9;
		break;
		case '7': layoutN=12;
		break;
		default: layoutN=1
	}
	var credit0 = parseInt($('#credit0').html());
	var credit1 = credit0 - Math.round((paperN*Math.ceil(pageN/doubleN/layoutN)+colorN*Math.ceil(pageN/layoutN))*copyN+bindN);
	$('#credit1').html(Math.max(0, credit1));
}

/* ---------- Slider Effect ---------- */

function refreshSlider(){
	var copyN=parseInt($("span#copyNumber").html());
	var i;
	for (i=1; i<copy.length; i++)
		if (copy[i]>copyN) break;
	var left=copyN-copy[i-1];
	var right=copy[i]-copyN;
	if (left < right) i--;
	$("div#workers-slider").slider("value", i);
}

$(function(){
	
	$('div.wDummy').css('height', Math.max(parseInt($('#w1').css('height')), parseInt($('#w2').css('height')), parseInt($('#w3').css('height')), parseInt($('#w4').css('height')), parseInt($('#w5').css('height')), parseInt($('#w6').css('height')), parseInt($('#w7').css('height')), parseInt($('#w8').css('height')))+'px');

	$('#btn1').hover(function(){
		$('#btn0').addClass('hover0');
	}, function(){
		$('#btn0').removeClass('hover0');
	});
		
	$('#btn1, #btn2, #btn3, #btn4, #btn5, #btn6, #btn7, #btn8').click(function(){
		var pastSelectedBtn = $('.innerBtn.selected', $(this).parent().parent());
		if ($(this).attr('id') == pastSelectedBtn.attr('id')){
			toggleFocusBtn($(this), 0, 0);
			wFade(btn2w($(this)), 0, 0);
			$('.wDummy').slideUp(500);
		}
		else{
			if (pastSelectedBtn.length){
				toggleFocusBtn(pastSelectedBtn, 0, 0);
				wFade(btn2w(pastSelectedBtn), 0, 0);
				wFade(btn2w($(this)), 1, 0);
			}
			else{
				$('.wDummy').slideDown(500);
				wFade(btn2w($(this)), 1, 500);
	            $.scrollTo($('#btnWrapper'), {
	                duration: 500,
	                offset: { top: -30 }
	            });
			}
			toggleFocusBtn($(this), 1, 0);
		}
	});
	
	$('#btn1, #btn2, #btn3, #btn4, #btn5, #btn6, #btn7, #btn8').hover(function(){
		var pastSelectedBtn = $('.innerBtn.selected', $(this).parent().parent());
		if (pastSelectedBtn.length && $(this).attr('id') != pastSelectedBtn.attr('id'))
		{
			btn2w($(this)).css('z-index', '100');
			wFade(btn2w($(this)), 1, 0);
		}
	}, function(){
		var pastSelectedBtn = $('.innerBtn.selected', $(this).parent().parent());
		if (pastSelectedBtn.length && $(this).attr('id') != pastSelectedBtn.attr('id'))
		{
			wFade(btn2w(pastSelectedBtn), 1, 0);
			wFade(btn2w($(this)), 0, 0);
		}
		btn2w($(this)).css('z-index', '0');
	});
	
	$('#credit').hover(function(){
		$('#btnWrapper').css('background-position', '0 -80px');
	}, function(){
		$('#btnWrapper').css('background-position', '0 0');
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
	
	// click on w1 item
	$('input[type="file"]').change(function(){
		if ($(this).val() != '') showMore(1);
	});
		
	// click on w2 item
	$('div.w2item').click(function(){
		$('#w2Form').val($('div.storeId', this).html());
		$('#w2Edit').html($('h2', this).html());
		showMore(2);
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
		showMore(3);
	});
	
	// click on w4 item
	
	$('div.w4item').click(function(){
		var col=$(this).parent().index();
		var colName=$(this).parent().parent().siblings().eq(0).children().eq(col).html();
		$('#w4Form').val(col);
		$('#w4Edit').html(colName);
		refreshCredit();
		showMore(4);
	});
	
	// click on w5 item

	$('div.w5item').click(function(){
		var col=$(this).parent().index();
		var colName=$(this).parent().parent().siblings().eq(0).children().eq(col).html();
		$('#w5Form').val(col);
		$('#w5Edit').html(colName);
		refreshCredit();
		showMore(5);
	});
	
	// click on w6 plus and minus
	
	$('#copyP1').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())<1000){
			a.html(parseInt(a.html())+1);
			refreshCredit();
			refreshSlider();
		}
	});

	$('#copyM1').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())>1){
			a.html(parseInt(a.html())-1);
			refreshCredit();
			refreshSlider();
		}
	});

	$('#copyP10').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())<991){
			a.html(parseInt(a.html())+10);
			refreshCredit();
			refreshSlider();
		}
	});

	$('#copyM10').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())>10){
			a.html(parseInt(a.html())-10);
			refreshCredit();
			refreshSlider();
		}
	});
	
	// click w6 confirm btn
	
	$('#w6ConfirmBtn').click(function(){
		var pageNumber=$("div#dynos-slider").slider('value');
		var copyNumber=parseInt($("span#copyNumber").html());
		$('#w6Form1').val(pageNumber);
		$('#w6Edit1').html(page[pageNumber][0]);
		$('#w6Form2').val(copyNumber);
		$('#w6Edit2').html(copyNumber+'份');
		refreshCredit();
		showMore(6);
	});
	
	// click on w7 item
	
	$('div.w7item').click(function(){
		var col=$(this).parent().index();
		var colName=$(this).parent().parent().siblings().eq(0).children().eq(col).html();
		$('#w7Form').val(col);
		$('#w7Edit').html(colName);
		refreshCredit();
		showMore(7);
	});
		
	// hover on w8 item
	$('.editForm').hover(function(){
		$('#btn'+$('h4', this).attr('id')[1]).addClass('hover');
	}, function(){
		$('#btn'+$('h4', this).attr('id')[1]).removeClass('hover');
	});
	
	// click on w8 item
	$('#w8ConfirmBtn').click(function(){
		$('#w8Form').val($('#w8Edit').val());
		$('#w9Form').val(parseInt($('#credit0').html())-parseInt($('#credit1').html()));
		$('#formOrder').submit();
	});
				
	$('.editForm').click(function(){
		var tmpN=$('h4', this).attr('id')[1];
		toggleFocusBtn($('#btn8'), 0, 0);
		toggleFocusBtn($('#btn'+tmpN), 1, 250);
		wFade($('#w8'), 0, 0);
		wFade($('#w'+tmpN), 1, 250);
	});

	var _slider=$("div#dynos-slider").slider({
		animate: 'true',
		orientation: "vertical",
		min: 0,
		max: 5,
		value: 0,
		slide: function(event, ui){
			$('span#dynos-handle-inner-dynos').html(page[ui.value][0]);
			$('span#pageNumber').html(page[ui.value][1]);
			refreshCredit();
		}
	});

	_slider.find('a').html(
	'<span id="dynos-handle-inner"><span id="pageNumber">1</span><span id="dynos-handle-inner-dynos">1-10页</span></span>'
	);
	
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
		
	$('h3', 'div.taskItem').click(function(){
		if ($(this).hasClass('selected')){
			$(this).removeClass('selected');
			$('div.taskDetail', $(this).parent()).slideUp(250);
		}
		else{
			$(this).addClass('selected');
			$('div.taskDetail', $(this).parent()).slideDown(250);
		}
	});
	
	$('span.msgClose').click(function(){
		$(this).parent().hide(250);
		$('span#unread').html(parseInt($('span#unread').html())-1);
	});
	
	$('div#msgClearAll').click(function(){
		$('ul.unreadContent li').hide(500);
		$('span#unread').html(0);
	});
	
	$('input#taskSearch').keyup(function(){
		if ($('input#taskSearch').val()==''){
			$('div.taskItem', $('#taskAccordion')).show(250);
		}
		else{
			var key=$('input#taskSearch').val();
			$('div.taskItem', $('#taskAccordion')).each(function(){
				var str=$('td:lt(4)', this).text()+$('span.taskStatus', this).html();
				if (str.search(key)==-1) $(this).hide(250);
				else $(this).show(250);
			});
		}
	});
	
	
})

