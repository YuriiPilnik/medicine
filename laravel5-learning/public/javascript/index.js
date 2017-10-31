$(document).ready(function() {
$(function() {
	$("#dialog").dialog({
		autoOpen: false
	});
$("#buttonReg").on("click", function() {
	$("#dialog").dialog("open");
});
$("#buttonAuth").on("click", function(){
	$("#dialogAuth").dialog("open");
});
});
$("#submit").click(function(e) {
	var ps1 = $("#password1").val();
	var ps2 = $("#password2").val();
	var name = $("#name").val();
	if (name == '' || ps1 == '' || ps2 == '') {
		alert("Заполните все поля!!!");
		e.preventDefault();
	} else if (ps1 != ps2) {
		alert("Несовпадают пароли!!!");
		e.preventDefault();
	}
	else if(ps1.length <= 3 ){
		alert("Небезопасный пароль");
		e.preventDefault();	
	}
	else {
		$("#password1").val(ps1);
		$("#name").val(name);
		alert("Регистрация прошла успешно!!!");
	}
});
$("#submitAuth").click(function(e){
	var ps3 = $("#passwordAuth1").val();
	var name1 = $("#nameAuth").val();

	if(name1 == '' || ps3.length <= 3) {
		alert("Некоректно введены данные.");
		e.preventDefault();
	}
	else {
		$("#password1").val(ps3);
		$("#name").val(name1);	
	}
});
});
