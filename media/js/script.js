
var Notification = {
	init: function(){
		this.$slider = $('#dummyNotification');
		this.$container = $('#notification');
		this.$counter = $('#notificationCount', this.$container);
		this.sound = document.getElementById('notif-sound');
		this.count = parseInt(this.$counter.html());
		var Notif = this;
		$('#notificationClose').click(function(){
			Notif.dismiss();
		});
		if(this.count > 0)
			this.delay(250).show(250);
	},
	add: function(html){
		html = html || "Don't look at me. #" + this.count;
		var $m = $('<div />').addClass('notificationContent').html(html);
		this.$counter.html(++this.count);
		if(this.count == 1){
			$m.insertAfter(this.$counter);
			this.show();
		} else {
			var $n = $('div.notificationContent:first', this.$container)
			$m.hide().insertBefore($n).delay(250).fadeIn(250);
			$n.fadeOut(250).fadeIn(250);
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
//		$m.slideUp('fast',function(){$(this).remove()});
	},
	markread: function(id){
//		send ajax request to mark message as read.
	},
	playsound: function(){
		this.sound.play();
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
				$(this).fadeTo(1000, 0.1).fadeTo(1000, 1);
		});
	};
})(jQuery);

$(function(){
	Notification.init();
//	tryNotification();
})
