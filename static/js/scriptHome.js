$(document).ready(function(){

	var pastStep=0;
	var currentStep=0;

	var step=[
		['type', '选择文档类型', ''], 
		['file', '选择文件', '上传文件'],
		['store', '选择打印店', '选择打印店'], 
		['paper', '选择纸张种类', '选择纸张'],
		['color', '选择油墨种类', '选择油墨'],
		['double', '选择单面/双面打印', '环保设置'],
		['layout', '选择版式放缩', '版式放缩'],
		['page', '估计上传文件的页数', '估计页数'],
		['copy', '选择打印份数', '打印份数'],
		['bind', '选择装订样式', '装订服务'],
		['cover', '是否添加封面', '添加封面'],
		['note', '给店主留言并确认订单', '客户留言']
	];

	function changeStatus(c){
		$('#status').fadeOut(function(){
			$('#status').html(c);
			$('#status').fadeIn();
		});
	}
	
	function findUnset(){
		var i;
		for (i=0; i<step.length; i++){
			if ($('form>input[name="'+step[i][0]+'"]').val()=='') break;
		}
		return i;
	}
	
	function setDefault(b)
	{
		var i;
		for (i=0; i<step.length; i++){
			var d=step[i][0];
			$('form>input[name="'+d+'"]').val($('#'+b+'Default>[name="'+d+'"]').val());
		}
	}
	
	function showMore(){
		pastStep=currentStep;
		currentStep=findUnset();
		changeStatus(step[currentStep][1]);
		var aout=new Array(), aup=new Array(), adown=new Array(), ain=new Array();
		var change=['#'+step[currentStep][0]+'Btn', step[currentStep][2]];
		var i;
		for (i=pastStep; i>=currentStep; i--) aout.push('#'+step[i][0]+'Btn');
		for (i=pastStep; i<=currentStep; i++) ain.push('#'+step[i][0]+'Btn');
		aup.push('#'+step[pastStep][0]+'Wrapper');
		if (currentStep==0) aup.push('#'+step[0][0]+'Wrapper');
		else{
			adown.push('#'+step[0][0]+'Wrapper');
			adown.push('#'+step[currentStep][0]+'Wrapper');
		}
		animationOutUpChangeDownIn(aout, aup, change, adown, ain);
	}
	
	function animationOutUpChangeDownIn(aout, aup, change, adown, ain){
		var i;
		var atime=800;
		for (i=0; i<aout.length; i++){
			$(aout[i]).fadeOut(atime);
		}
		for (i=0; i<aup.length; i++){
			$(aup[i]).slideUp(atime);
		}
		$(change[0]).delay(atime).val(change[1]);
		for (i=0; i<adown.length; i++){
			$(adown[i]).delay(atime).slideDown(atime);
		}
		for (i=0; i<ain.length; i++){
			$(ain[i]).fadeIn(atime);
		}
	}

	$("#toggleMap").toggle(function(){
		$("#storeMap").slideDown();
		$(this).html('隐藏地图');
	},function(){
		$("#storeMap").slideUp();
		$(this).html('显示地图');
	});

	$('.storeItem').click(function(){
		$('input[name="store"]').val($(this).children('input[name="pId"]').val());
		$('#storeBtn').val($(this).children('input[name="pName"]').val());
	});
	
/* CLICK */

	$('.taskTypeBtn').click(function(){
		var a=$(this).children('input[name="value"]').val();
		var b=$(this).children('input[name="name"]').val();
		if ($('form>input[name="type"]').val()==a){
			$('form>input[name="type"]').val('');
			$(this).removeClass('taskTypeSelected');
			showMore();
		}
		else {
			setDefault(b);
			$('form>input[name="type"]').val(a);
			$('div.taskTypeBtn.taskTypeSelected').each(function(){
				$(this).removeClass('taskTypeSelected');
			});
			$(this).addClass('taskTypeSelected');
			showMore();
		}
	});
	
	$('form>input[type="file"]').change(function(){
		showMore();
	});
	
	$('.uiBtn2').click(function(){
		$('form>input[name='+$(this).attr('name')+']').val('');
		showMore();
	});
	
	$('.item').click(function(){
		var formName=$(this).siblings('input[name="id"]').val();
		var formValue=$(this).children('input[name="value"]').val();
		$('form>input[name="'+formName+'"]').val(formValue);
		showMore();
	});

})