
var page=[['页数很少','1-10页',1],['页数较少','10-50页',10],['页数多','50-200页',50],['页数较多', '200-500页',200],['页数很多','500-1000页',500], ['页数非常多','1000页以上'],1000];
var copy=[1,2,3,4,5,6,7,8,9,10,20,30,40,50,60,70,80,90,100,200,300,400,500,600,700,800,900,1000];
var $slider1;

$(function(){
	
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
	
	$('.storeItem, .w3item, .w4item, .w5item, .w7item').click(function(){
		var classname=$(this).attr('class');
		$('.'+classname).removeClass('selected');
		$(this).addClass('selected');
	});
	
	function refreshCredit(){
		
	}
	
	$slider1 = $("div#dynos-slider").slider({
		orientation: "vertical",
		range: "min",
		min: 0,
		max: 5,
		value: 0,
		slide: function(event, ui){
			setSlider1(ui.value);
		}
	});

	$slider1.find('a').html(
			'<span id="dynos-handle-inner">'+
			'<span id="dynos-handle-inner-dynos"></span>'+
			'<span id="dynos-handle-inner-price"></span>'+
			'</span>'
			)
		.removeAttr('href');
	
	$("#workers-slider").slider({
		orientation: "vertical",
		range: "min",
		min: 0,
		max: 27,
		value: 0,
		slide: function(event, ui){
			$("span#copyNumber").html(copy[ui.value]);
			refreshCredit();
		}
	});

	setSlider1(1);

})

function setSlider1(qty) {
	var tmpValue = page[qty];
	$slider1.slider('value', qty);
	$('span#dynos-handle-inner-dynos').html(tmpValue[0]);
	$("span#dynos-handle-inner-price").html(tmpValue[1]);
//	refreshCredit();
}
