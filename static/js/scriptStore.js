$(document).ready(function(){
	$("#toggleMap").click(function(){
		if ($(this).html()=='显示地图'){
			$("#storeMap").slideDown();
			$(this).html('隐藏地图');			
		}
		else{
			$("#storeMap").slideUp();
			$(this).html('显示地图');
		}
	});
	$('.taskType').click(function(){
		if ($(this).hasClass('taskSelected'))
			$(this).removeClass('taskSelected');
		else{
			$('.taskSelected').removeClass('taskSelected');
			$(this).addClass('taskSelected');
		}
		$('.taskType').each(function(){
			if ($(this).hasClass('taskSelected'))
				$('#'+$(this).attr('id')+'Detail').slideDown();
			else
				$('#'+$(this).attr('id')+'Detail').slideUp();
		})
	});

})
