$(document).ready(function(){
	$("#toggleMap").toggle(function(){
		$("#storeMap").slideDown();
		$(this).html('隐藏地图');
	},function(){
		$("#storeMap").slideUp();
		$(this).html('显示地图');
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
	
	$('#pdfonline').click(function(){
		$('#pdfServiceRadio1').attr('checked', 'checked');
		$('#pdfPage0').slideUp(function(){
			$('#pdfPage1').slideDown();
		})
	});
	$('#pdfoffline').click(function(){
		$('#pdfServiceRadio0').attr('checked', 'checked');
		$('#pdfPage1').slideUp(function(){
			$('#pdfPage0').slideDown();
		})
	});
	$('#pdfCal').click(function(){
		$(this).hide();
		$('#pdfCorrect').show();
		$('#pdfConfirmPage').slideDown();
		$('.pdfOb').each(function(){
			$(this).attr('disabled', 'true');
		});
	});
	$('#pdfCorrect').click(function(){
		$(this).hide();
		$('#pdfCal').show();
		$('#pdfConfirmPage').slideUp();
		$('.pdfOb').each(function(){
			$(this).attr('enabled', 'true');
		});
	});
})