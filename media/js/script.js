$(document).ready(function(){
	$('INPUT.autoHint, TEXTAREA.autoHint').blur(function(){
	    if($(this).val() == '' && $(this).attr('title') != ''){
	       $(this).val($(this).attr('title'));
	       $(this).addClass('autoHint');
	    }
	});
	$('INPUT.autoHint, TEXTAREA.autoHint').each(function(){
	    if($(this).attr('title') == ''){ return; }
	    if($(this).val() == ''){ 
	    	$(this).val($(this).attr('title'));
	    }
	    else { 
	    	$(this).removeClass('autoHint');
	    }
	});
	$('INPUT.autoHint, TEXTAREA.autoHint').focus(function(){
	    if($(this).val() == $(this).attr('title')){
	        $(this).val('');
	        $(this).removeClass('autoHint');
	    }
	});
})
