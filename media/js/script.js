/** rewrote notification into an object
 *
function addNotification(id, content){
	$('#notification div.notificationContent:first').fadeOut('normal', function(){
		$('#notificationCount').html(parseInt($('#notificationCount').html())+1);
		$('#notification div.notificationContent:first').before($('#notification div.notificationContent:last').clone());
		$('#notification div.notificationContent:first').hide();
		$('#notification div.notificationContent:first span').html(content);
//		$('#notification div.notificationContent:first input[type="hidden"]').val(id);
		$('#notification div.notificationContent').fadeIn('normal');
	})
	if ($('#notificationCount').html()=='1')
	{
		$('#dummyNotification').slideDown('normal');
		$('#notification').delay(250).fadeIn('normal');
	}
}

function removeNotification(){
	$('div#notification div.notificationContent:first').remove();
	$('#notificationCount').html(parseInt($('#notificationCount').html())-1);
	if ($('#notificationCount').html()=='0'){
		$('#dummyNotification').slideUp('normal');
		$('#notification').fadeOut('normal');
	}
}

function tryNotification(){
//	$('#notificationCount').html($('div#notification div.notificationContent').length-1);
	$('#notificationClose').click(function(){
		removeNotification();
	})
	if ($('#notificationCount').html()!='0')
	{
		$('#dummyNotification').delay(500).slideDown('normal');
		$('#notification').delay(750).fadeIn('normal');
	}
}
 */

var Notification = {
	init: function(){
		this.$slider = $('#dummyNotification');
		this.$container = $('#notification');
		this.$counter = $('#notificationCount', this.$container);
		this.count = parseInt(this.$counter.html());
		var Notif = this;
		$('#notificationClose').click(function(){
			Notif.dismiss();
		});
		if(this.count > 0)
			this.show('slow');
	},
	add: function(html){
		html = html || "Don't look at me. #" + this.count;
		var $m = $('<div />').addClass('notificationContent').html(html);
		this.$counter.html(++this.count);
		if(this.count == 0){
			$m.insertAfter(this.$counter);
			this.show();
		} else {
			var $n = $('div.notificationContent:first', this.$container)
			$m.hide().insertBefore($n).delay(400).fadeIn();
			$n.fadeOut(400).fadeIn();
		}
	},
	show: function(duration){
		duration = duration || 'normal';
		this.$slider.slideDown(duration);
		this.$container.delay(250).fadeIn(duration);
	},
	hide: function(){
		this.$slider.slideUp();
		this.$container.fadeOut();
	},
	dismiss: function(){
		var mid, $m = $('div.notificationContent:first', this.$container);
		if(mid = parseInt($m.attr('data-id')))
			this.markread(mid);
		if(--this.count == 0)
			this.hide();
		this.$counter.html(this.count);
		$m.remove();
	},
	markread: function(id){
//		send ajax request to mark message as read.
	},
}

function showLightbox(id){
	$('div.lightbox > div[id!="dummyLightbox"]').hide();
	$('div.lightbox').show();
	$(id, 'div.lightbox').fadeIn(250);
	$(id, 'div.lightbox').addClass('inLightbox');
}

function hideLightbox(){
	$('div.lightbox .inLightbox').fadeOut(250, function(){
		$(this).removeClass('inLightbox');
		$('div.lightbox').hide();
	});
}

/* i wrote a jquery plugin to replace this func
 * obFlash()
 * you can safely delete it.
function objectFlash(id, times){
	times = times || 5;
	for (var i=0; i<times; i++) $(id).fadeTo(500, 0.2).fadeTo(500, 1);
}
 */

(function($){
	$.fn.obFlash = function(repeat) {
		repeat = repeat || 3;
		return this.each(function(){
			for (var i = 0; i++ < repeat; )
				$(this).fadeTo(500, 0.2).fadeTo(500, 1);
		});
	};
})(jQuery);

$(function(){
	Notification.init();
//	tryNotification();
})
