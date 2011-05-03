/**
 * @author Roy John
 */

$(document).ready(function(){
	$("#loginBtn").click(function(){
		$("#login").show("normal");
		$("#signup").hide("normal");
		$("#forget").hide("normal");
	});
	$("#signupBtn").click(function(){
		$("#login").hide("normal");
		$("#signup").show("normal");
		$("#forget").hide("normal");
	});
	$("#forgetBtn").click(function(){
		$("#login").hide("normal");
		$("#signup").hide("normal");
		$("#forget").show("normal");
	})
})
