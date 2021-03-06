var storeItemInfoHover=0;
var peekEnable=0;
var copy=[1,2,3,4,5,6,7,8,9,10,20,30,40,50,60,70,80,90,100,200,300,400,500,600,700,800,900,1000];

/* ---------- FILTER ---------- */

function refresh_filter() {
	var a = new Array();
	var b = 0;
	for (var i = 0; i < 6; i++) {
		a[i] = $('span.taskStatus'+i).length;
		b += a[i];
	}
	$('#orderFilter > div').each(function(){
		if ($(this).data('status') == 'all') $('span', this).html(b);
		else $('span', this).html(a[$(this).data('status')]);
	})
}

function show_filtered_order(s) {
	if (s == 'all') $('div.taskItem', $('#taskAccordion')).show(250);
	else $('div.taskItem', $('#taskAccordion')).each(function() {
		if ($('span.taskStatus', this).hasClass('taskStatus'+s)) $(this).show(250);
		else $(this).hide(250);
	});
}

/* ---------- SHOW MORE ---------- */

function refreshW8(){
	if ($('#w2Form').val()!='') $('#w2Edit').html(Vault.stores[$('#w2Form').val()].name);
	if ($('#w3Form1').val()!='') $('#w3Edit1').html(order_option_text.paper[$('#w3Form1').val()]);
	if ($('#w3Form2').val()!='') $('#w3Edit2').html(order_option_text.color[$('#w3Form2').val()]);
	if ($('#w4Form').val()!='') $('#w4Edit').html(order_option_text.back[$('#w4Form').val()]);
	if ($('#w5Form').val()!='') $('#w5Edit').html(order_option_text.layout[$('#w5Form').val()]);
	if ($('#w6Form').val()!='') $('#w6Edit').html($('#w6Form').val()+'份');
	if ($('#w7Form').val()!='') $('#w7Edit').html(order_option_text.misc[$('#w7Form').val()]);
}

function showMore(n){
	refreshW8();
	var formStatus=[
		true,
		($('#w2Form').val()!=''),
		($('#formFile input[type="file"]').val()!=''),
		($('#w3Form1').val()!='' && $('#w3Form2').val()!=''),
		($('#w4Form').val()!=''),
		($('#w5Form').val()!=''),
		($('#w6Form').val()!=''),
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
			$('#btn'+i).delay(250*j).fadeIn(250);
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
	ob.delay(del).fadeIn(250);
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

function order_apply_setting($order) {
	$('#formOrder input').each(function(){
		var source = $('input[name="' + this.name + '"]', $order);
		if(source.length == 0) return;
		$(this).val(source.val());
	});
}
function order_bind_action(expand) {
	expand = expand || 0;
	$('#taskAccordion h3.newly_added')
		.removeClass('newly_added')
		.each(function(){
			if(expand != 0) {
				$(this).addClass('selected')
					.find('span.taskStatus').obFlash()
					.end().next().slideDown(500);
			}
		})
		.click(function(){
			$(this).parent().siblings('div.taskItem').find('h3.selected').each(function(){
				$(this).removeClass('selected').next().slideUp(500);
			});
			$(this).toggleClass('selected')
				.next().slideToggle(500);
		})
		.parent().each(function(){
			var pid = $('div.taskDetail', this).data('pid');
			var store = Vault.stores[pid];
			$('span.newly_added', this).each(function(){
				$(this).html(store[$(this).data('name')]);
			});
		}).end()
		.next().find('a.cancel-order').click(function(){
			var $div = $(this).closest('div.taskDetail');
			var param = new Object();
			param['oid'] = $('input[name="id"]', $div).val();
			param['act'] = 0;
			$.ajax({
				type: "post",
				url: "/xhr/order-action.php",
				cache: false,
				data: param,
				dataType: 'json',
				statusCode: {
					200: function(data){
						switch (data.errno){
							case 5:
								Notification.add('订单正在打印，无法撤消');
							case 0: 
							case 4: 
								$div.slideUp(500, function(){
									Notification.playsound();
									$div.parent().replaceWith(data.html);
									order_bind_action(1);
									refresh_filter();
								})
								break;
							case 6:
								Notification.add('啊哦，服务器开小差了，请稍候再试');
								break;
							default: window.location.reload();
						}
					}
				}
			});
		})
		.end().find('span.showStoreInLightbox').click(function(){
			var storeId = $(this).parents('div.taskDetail').data('pid');
			changeStoreInLightbox(storeId);
			showLightbox('div.panel.board');
		});
}

$(function(){
	
	$('div.wDummy').css('height', Math.max(parseInt($('#w1').css('height')), parseInt($('#w2').css('height')), parseInt($('#w3').css('height')), parseInt($('#w4').css('height')), parseInt($('#w5').css('height')), parseInt($('#w6').css('height')), parseInt($('#w7').css('height')), parseInt($('#w8').css('height')))+'px');

	if ($('div#taskAccordion > div.taskItem').length == 0) {
		$('div.taskQueue').hide();
		$('div.wDummy').show();
		toggleFocusBtn($('#btn1'), 1, 0);
		wFade(btn2w($('#btn1')), 1, 0);
	}

	$('#btn1').hover(function(){
		$('#btn0').addClass('hover0');
	}, function(){
		$('#btn0').removeClass('hover0');
	});
	
	$('#btn1, #btn2, #btn3, #btn4, #btn5, #btn6, #btn7, #btn8').click(function(){
		var pastSelectedBtn = $('.innerBtn.selected', $(this).parent().parent());
		if ($(this).attr('id') == pastSelectedBtn.attr('id')) {
			if ($('div#taskAccordion > div.taskItem').length > 0) {
				toggleFocusBtn($(this), 0, 0);
				wFade(btn2w($(this)), 0, 0);
				$('.wDummy').slideUp(500);
			}
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
		if (peekEnable && pastSelectedBtn.length && $(this).attr('id') != pastSelectedBtn.attr('id'))
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
			
	// click on w2 item
	$('div.w2item').click(function(){
		if (storeItemInfoHover) return;
		$('.'+$(this).attr('class')).removeClass('selected');
		$(this).addClass('selected');
		$('#w2Form').val($('div.storeId', this).html());
		showMore(1);
	});
	
	// click on w3 item
	$('div.w3item').click(function(){
		col=$(this).parent().index();
		row=$(this).parent().parent().index();
		$('#w3Form1').val(col);
		$('#w3Form2').val(row);
		showMore(3);
	});
	
	// click on w4 item
	
	$('div.w4item').click(function(){
		var col=$(this).parent().index();
		$('#w4Form').val(col);
		showMore(4);
	});
	
	// click on w5 item

	$('div.w5item').click(function(){
		var col=$(this).parent().index();
		$('#w5Form').val(col);
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
		showMore(6);
	});
	
	// click on w7 item
	
	$('div.w7item').click(function(){
		var col=$(this).parent().index();
		$('#w7Form').val(col);
		showMore(7);
	});
		
	// hover on w8 item
	$('.editForm').hover(function(){
		$('#btn'+$('h4', this).attr('id')[1]).addClass('hover');
	}, function(){
		$('#btn'+$('h4', this).attr('id')[1]).removeClass('hover');
	});
	$('#w8Edit').focus(function(){
		$(this).parents('div.confirmForm').addClass('active');
	})
	$('#w8Edit').blur(function(){
		$(this).parents('div.confirmForm').removeClass('active');
	})
	
	// click on w8 item
	$('#w8ConfirmBtn').click(function(){
		if ($('#w8Edit').val()=='') $('#w8Form').val('');
		else $('#w8Form').val($('#w8Edit').val());
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
				var str=$('td:lt(5)', this).text()+$('span.taskStatus', this).html();
				if (str.search(key)==-1) $(this).hide(250);
				else $(this).show(250);
			});
		}
	});

	$('#orderFilter > div').click(function() {
		show_filtered_order($(this).data('status'));
	});

	refresh_filter();

	order_bind_action();
	order_apply_setting($('#taskAccordion > div.taskItem:first'));

/*---------------------- LIGHTBOX ----------------------*/	
	
	$('div.storeItemInfo input[type="button"]').hover(function(){
		storeItemInfoHover = 1;
	}, function(){
		storeItemInfoHover = 0;
	});
	
	$('div.storeItemInfo input[type="button"]').click(function(){
		var storeId=$('div.storeId', $(this).parent()).html();
		changeStoreInLightbox(storeId);
		showLightbox('div.panel.board');
	});
	
	$('ul.storeNav li').click(function(){
		if (!$(this).hasClass('selected')){
			var past=$('ul.storeNav li.selected');
			var current=$(this);
			past.removeClass('selected');
			current.addClass('selected');
			$('div.storeDetail div:eq('+past.index()+')').hide();
			$('div.storeDetail div:eq('+current.index()+')').show();
		}
	})

	$('span.storeClose').click(function(){
		hideLightbox();
	});
	$('#dummyLightbox').click(function(){
		hideLightbox();
	});
	
})

function changeStoreInLightbox(storeId){
	var storeName;
	var storeMsg;
	$('div.storeItemInfo div.storeId').each(function(){
		if ($(this).html()==storeId){
			storeName=$('h2', $(this).parent()).html();
			storeMsg=$('h2', $(this).parent()).next().html();
		}
	})
	$('#lightboxStoreName').html(storeName);
	$('#lightboxStoreAvatar').attr('src', '/media/images/store/storeAvatar'+storeId+'.jpg');
	$('#msgContent').html(storeMsg);
	$('#storeView img').attr('src', '/media/images/store/storeView'+storeId+'.jpg');
	$('#storeMap img').attr('src', '/media/images/store/storeMap'+storeId+'.png');
}

var UP = {
	start: function(){
//		check former upload.
		this.filename = $('#formFile input[name="file"]').val();
		this.id = this.makeid();
		$('#formFile input[name="UPLOAD_IDENTIFIER"]').val(this.id);
		var $bar = $('#status');
		$('span:first', $bar).html(this.basename(this.filename).substr(0,30));
		$('div > div', $bar).width('0px');
		$bar.slideDown();
		$('#formFile').submit();
		var t = this;
		this.timer = setInterval(function(){
			t.update();
		}, 500);
	},
	update: function(){
		var t = this;
		if(t.ajax === true) return;
		t.ajax = true;
		$.ajax({
			type: 'get',
			data: 'id=' + t.id,
			url: '/xhr/upload-progress.php',
			cache: false,
			dataType: 'json',
			success: function(data){
				t.ajax = false;
				if(data.id == 0) return;
				$('#status > div > div').animate({width: data.percentage}, 500);
			},
		});
	},
	stop: function() {
		clearInterval(this.timer);
	},
	fail: function() {
		$('#status span:last').html('上传失败');
	},
	success: function(html) {
		var size = $('#upload-size', html).text();
		var name = $('#upload-name', html).text();
		$('#status > div > div').dequeue().animate({width: 200}, 500);
		$('#status span:last').html('上传完成 (' + size + ')');
		$('#formOrder input[name="fid"]').val(this.id);
		$('#formOrder input[name="fname"]').val(name);
		$('#w8ConfirmBtn').removeAttr('disabled').val('确认并提交订单');
	},
	basename: function(path) {
		return path.replace(/\\/g, '/').replace(/.*\//, '');
	},
	makeid: function() {
		var id = '';
		var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		for( var i=0; i < 8; i++ )
			id += charset.charAt(Math.floor(Math.random() * charset.length));
		return id;
	},
}
function order_form_reset() {
	peekEnable=0;
	$('#w8').hide();
	$('#status, div.wDummy').slideUp(500);
	$('.w').fadeOut(500).hide();
	var i;
	for (i=8; i>1; i--) $('#btn'+i).delay((8-i)*250).fadeOut(250, function(){
		$(this).removeClass('selected');
		if (i==2) peekEnable=1;
		$('#w8ConfirmBtn').val('文件上传中');
		$('#w8ConfirmBtn').attr('disabled', 'true');
	});
	$('form#formFile input[type="file"]').replaceWith('<input type="file" name="file">');
	$('form#formFile input[type="file"]').change(function(){
		if($(this).val() != ''){
			UP.start();
			showMore(2);
		}
	});
}
function order_list_refresh() {
	$('div.order_open').each(function() {
		order_status(this);
	});
}
function order_status(row) {
	var param = new Object();
	param['oid'] = $('div.taskDetail', row).data('id');
	param['status'] = $('div.taskDetail', row).data('status');
	$.ajax({
		type: "get",
		url: "/xhr/order-unit-status.php",
		cache: false,
		data: param,
		dataType: 'html',
		statusCode: {
			200: function(data){
					var $html = $(data);
					$(row).find('div.taskDetail').slideUp(500, function(){
	                    $(row).replaceWith($html);
	                    $(row).next().slideDown(500);
	                    refresh_filter();
	                    $html.find('span.taskStatus').obFlash();
	                    order_bind_action(1);
						Notification.playsound();						
					})
				}
		}
	});
}
function order_submit() {
	$.ajax({
		type: "post",
		url: "/xhr/order-submit.php",
		cache: false,
		data: $('#formOrder').serialize(),
		dataType: 'json',
		statusCode: {
			200: function(data){
					if(data.errno == 0) {
						$('#taskAccordion').prepend(data.html);
						order_bind_action();
						order_form_reset();
						refresh_filter();
						$('div.taskQueue').slideDown(500);
						if(data.badge)
							Notification.add("<a href='/profile.php#2-2'>恭喜！您获得了" + data.badge.name + "徽章，点击查看详情。</a>");
					}
				}
		}
	});
//	loading animation.
}

$(function(){
	$('#formFile input[name="file"]').change(function(){
		if($(this).val() != ''){
			UP.start();
			showMore(2);
		}
	});
	$('iframe[name="ifr_upload"]').load(function(){
		if(UP.id === undefined) return;
		UP.stop();
		var c = $(this).contents();
		var r = $('#upload-result', c);
		if(r.length == 0 || r.text() != 'success')
			UP.fail();
		else
			UP.success(c);
	});

	setInterval(order_list_refresh, 60000);
});
