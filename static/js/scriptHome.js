$(document).ready(function(){
	$("#toggleMap").toggle(function(){
		$("#storeMap").slideDown();
		$(this).html('隐藏地图');
	},function(){
		$("#storeMap").slideUp();
		$(this).html('显示地图');
	});
	
	var op=0.01;
	var taskNum=0;
	
	function getTask(){
		var xmlhttp;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else{// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    	document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
		}
		xmlhttp.open("GET","ajaxTask.php?q="+taskNum,true);
		xmlhttp.send();
	}
		
	$("#leftBtn").click(function(){
		if (taskNum<=0) return;
		hideTask(0, 1, 2);
		getTask(taskNum-=1);
		showTask(0, 1, 2);
	})
	
	$("#rightBtn").click(function(){
		hideTask(2, 1, 0);
		getTask(taskNum+=1);
		showTask(2, 1, 0);			
	})
	
	function hideTask(a, b, c){
		
	}

	function showTask(a, b, c){
		
	}
})
