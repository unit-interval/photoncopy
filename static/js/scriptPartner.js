$(document).ready(function(){
	$('#msgChange').click(function(){
		$('#msgNew').val($('#msgBody').html());
		$('#msgChangePanel').slideDown('fast');
	});
	$('#msgCancel').click(function(){
		$('#msgChangePanel').slideUp('fast');
	});
	$('#lockMask > input[name="phrase"]').keyup(function(){
		if($(this).val() == $(this).next().val()){
			$(this).val('');
			$('#lockMask').hide();
		}
	});
	$('#storeLock').click(function(){
		$('#lockMask').show();
	})
})
