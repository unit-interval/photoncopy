$(document).ready(function(){
	$('#msgChange').click(function(){
		$('#msgNew').val($('#msgBody').html());
		$('#msgChangePanel').slideDown('fast');
	});
	$('#msgCancel').click(function(){
		$('#msgChangePanel').slideUp('fast');
	});
	$('#storeLock').click(function(){
		
	})
})
