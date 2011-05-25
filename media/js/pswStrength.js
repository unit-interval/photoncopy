function passwordStrength(f,i,d){
	var k=1,h=2,b=3,a=4,c=5,g=0,j,e;
	if((f!=d)&&d.length>0){
		return c
	}
	if(f.length<4){
		return k
	}
	if(f.toLowerCase()==i.toLowerCase()){
		return h
	}
	if(f.match(/[0-9]/)){
		g+=10
	}
	if(f.match(/[a-z]/)){
		g+=26
	}
	if(f.match(/[A-Z]/)){
		g+=26
	}
	if(f.match(/[^a-zA-Z0-9]/)){
		g+=31
	}
	j=Math.log(Math.pow(g,f.length));
	e=j/Math.LN2;
	if(e<40){
		return h
	}
	if(e<56){
		return b
	}
	return a
};

function b(){
	var e=$("#pass1").val(),d=$("#user_login").val(),c=$("#pass2").val(),f;
	if (d!='' && e==c && e.length>0) $('#pass-confirm').fadeIn(250);
	else $('#pass-confirm').fadeOut(250);
	$("#pass-strength-result").removeClass("short bad good strong");
	if(!e){
		$("#pass-strength-result").html('强度');
		return
	}
	f=passwordStrength(e,d,c);
	switch(f){
		case 2:$("#pass-strength-result").addClass("bad").html('弱');break;
		case 3:$("#pass-strength-result").addClass("good").html('中');break;
		case 4:$("#pass-strength-result").addClass("strong").html('强');break;
		case 5:$("#pass-strength-result").addClass("short").html('不匹配');break;
		default:$("#pass-strength-result").addClass("short").html('非常弱')
	}
}

$(function(){
	$('#user_login').val("").keyup(b);
	$("#pass1").val("").keyup(b);
	$("#pass2").val("").keyup(b);
})