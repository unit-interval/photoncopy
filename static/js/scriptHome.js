var storeItemInfoHover=0;
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

/* ---------- Slider Effect ---------- */

function refreshSlider(){
	var copyN=parseInt($("span#copyNumber").html());
	var i;
	for (i=1; i<copy.length; i++)
		if (copy[i]>copyN) break;
	var left=copyN-copy[i-1];
	var right=copy[i]-copyN;
	if (left < right) i--;
	$("div#dynos-slider").slider("value", i);
}

function order_apply_setting(order) {
	$('#formOrder input').each(function(){
		var source = $('input[name="' + this.name + '"]');
		if(source.length == 0) return;
		$(this).val(source.val());
	});
}
function order_bind_action() {
	$('#taskAccordion h3.newly_added').click(function(){
		if ($(this).hasClass('selected')){
			$(this).removeClass('selected');
			$('div.taskDetail', $(this).parent()).slideUp(250);
		}
		else{
			$(this).addClass('selected');
			$('div.taskDetail', $(this).parent()).slideDown(250);
		}
	})
		.removeClass('newly_added');
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
	
	$('.w3item, .w4item, .w5item, .w7item').click(function(){
		$('.'+$(this).attr('class')).removeClass('selected');
		$(this).addClass('selected');
	});
	
	// click on w1 item
	$('input[type="file"]').change(function(){
		if ($(this).val() != '') showMore(1);
	});
		
	// click on w2 item
	$('div.w2item').click(function(){
		if (storeItemInfoHover) return;
		$('.'+$(this).attr('class')).removeClass('selected');
		$(this).addClass('selected');
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
		showMore(3);
	});
	
	// click on w4 item
	
	$('div.w4item').click(function(){
		var col=$(this).parent().index();
		var colName=$(this).parent().parent().siblings().eq(0).children().eq(col).html();
		$('#w4Form').val(col);
		$('#w4Edit').html(colName);
		showMore(4);
	});
	
	// click on w5 item

	$('div.w5item').click(function(){
		var col=$(this).parent().index();
		var colName=$(this).parent().parent().siblings().eq(0).children().eq(col).html();
		$('#w5Form').val(col);
		$('#w5Edit').html(colName);
		showMore(5);
	});
	
	// click on w6 plus and minus
	
	$('#copyP1').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())<1000){
			a.html(parseInt(a.html())+1);
			refreshSlider();
		}
	});

	$('#copyM1').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())>1){
			a.html(parseInt(a.html())-1);
			refreshSlider();
		}
	});

	$('#copyP10').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())<991){
			a.html(parseInt(a.html())+10);
			refreshSlider();
		}
	});

	$('#copyM10').click(function(){
		var a=$("span#copyNumber");
		if (parseInt(a.html())>10){
			a.html(parseInt(a.html())-10);
			refreshSlider();
		}
	});
	
	// click w6 confirm btn
	
	$('#w6ConfirmBtn').click(function(){
		var copyNumber=parseInt($("span#copyNumber").html());
		$('#w6Form').val(copyNumber);
		$('#w6Edit').html(copyNumber+'份');
		showMore(6);
	});
	
	// click on w7 item
	
	$('div.w7item').click(function(){
		var col=$(this).parent().index();
		var colName=$(this).parent().parent().siblings().eq(0).children().eq(col).html();
		$('#w7Form').val(col);
		$('#w7Edit').html(colName);
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
		order_submit();
	});
				
	$('.editForm').click(function(){
		var tmpN=$('h4', this).attr('id')[1];
		toggleFocusBtn($('#btn8'), 0, 0);
		toggleFocusBtn($('#btn'+tmpN), 1, 250);
		wFade($('#w8'), 0, 0);
		wFade($('#w'+tmpN), 1, 250);
	});
	
	_slider = $("#dynos-slider").slider({
		animate: 'true',
		orientation: "vertical",
		min: 0,
		max: 27,
		value: 0,
		slide: function(event, ui){
			$("span#copyNumber").html(copy[ui.value]);
		}
	});
	
	_slider.find("a").html(
	'<span id="dynos-handle-inner"><span id="dynos-handle-inner-dynos"><span id="copyNumber">1</span>份</span></span>'
	);
		
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

	order_bind_action();
	
	$('#taskAccordion > div.taskItem:first').each(function() {
		order_apply_setting($('input', this));
	});
	
/*---------------------- LIGHTBOX ----------------------*/	
	
	$('div.storeItemInfo input[type="button"]').hover(function(){
		storeItemInfoHover = 1;
	}, function(){
		storeItemInfoHover = 0;
	});
	
	$('div.storeItemInfo input[type="button"]').click(function(){
		var storeName=$('h2', $(this).parent()).html();
		var storeId=$('div.storeId', $(this).parent()).html();
		var storeMsg=$('p', $(this).parent()).html();
		var content="<div class='panel board'>"+
				"<h2>"+storeName+"<span class='storeClose'>×</span></h2>"+
				"<div id='storeStatus'>"+
					"<div id='storeAvatar'><img width='100%' height='100%' src='./media/images/store/storeAvatar"+storeId+".jpg' alt='Store Avatar'/></div>"+
					"<div id='storeMsg'>"+
						"<div id='msgQuote'></div>"+
						"<div id='msgContent'>"+storeMsg+"</div>"+
					"</div>"+
					"<div class='clear'></div>"+
				"</div>"+
				"<div id='storeView'>"+
					"<img width='100%' src='./media/images/store/storeView"+storeId+".jpg' alt='Store View'/>"+
				"</div>"+
				"<div id='storeMap'>"+
					'<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/?ie=UTF8&amp;hq=&amp;hnear=Beijing+South+Railway+Station,+Fengtai,+Beijing,+China&amp;ll=39.864289,116.378515&amp;spn=0.005765,0.00912&amp;z=16&amp;output=embed"></iframe>'+
				"</div>"+
				"<p id='toggleMap'>显示地图</p>"+
			"</div>";

		showLightbox(content);
		
		$("#toggleMap").toggle(function(){
			$("#storeMap").slideDown();
			$(this).html('隐藏地图');
		},function(){
			$("#storeMap").slideUp();
			$(this).html('显示地图');
		});
		
		$('span.storeClose').click(function(){
		hideLightbox();
	});

	});
	
})