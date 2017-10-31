$(document).ready(function(){
	$.ajaxSetup({
 		headers: {
  		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		}
	});
	$(function(){
		$("#submitConclusion").click(function(){
			var idWrite = $("#idWriteIntoModal").val();
			var diagnoz = $("#diagnos").val();
			var note = $("#note").val();
			var isCorrect = true;
			if(diagnoz.length < 3){
				isCorrect = false;
				$("#messageDiagnos").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Please provide a valid diagnos.</div>");	
			}else{
				$("#messageDiagnos").html("<br>");
			}
			if(!isCorrect)
				return;
            $.ajax({
	        	type: "POST",
	         	url: 'submitIntoConslution',
	         	data: {idWrite: idWrite,
	         		diagnoz: diagnoz,
	         		note: note},
				success: function(msg) {
					$('.btn-default').click();
					window.location.reload();
				},
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
				}
	    	});
		});
	});
	$(function(){
		$(".makeDoctorReport").click(function(){
			var idWrite = $(this).closest('form').find("#idWrites").val();
			$("#hideIdWrite").html("<input type='hidden' id='idWriteIntoModal' value=" + idWrite + ">");
		});
	});
	$(function(){
		$("#submitEntryToDoctor").click(function(){
			var desrciptionAppoinment = $("#desriptionAppointment").val();
			var dateAppointment = $("#dateAppointment").val();
			var problem = $("#problem").val();
			// alert(problem);
			if(desrciptionAppoinment.length < 3){
				$("#messageAppointment").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Problem must be more then 3 symbols.</div>");
				return;
			}else {
				$("#messageAppointment").html("<br>");
			}
			$.ajax({
	        	type: "POST",
	         	url: 'submitIntoAppointment',
	         	data: {desrciptionAppoinment: desrciptionAppoinment,
	         		dateAppointment: dateAppointment,
	         		problem: problem},
				success: function(msg) {
						$('.btn-default').click();
						var obj = jQuery.parseJSON(msg);
						$("tbody").append("<tr><td>" + obj.type + "</td><td>" + obj.date + "</td><td>" + obj.description + "</td></tr>")
				},
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
				}
	    	});
		});
			
	});
	$(function(){
		$(".formAppointment").click(function(){
			 var id = $(this).closest('form').find("#idDoctorForAppend").val();
			 $.ajax({
	        	type: "POST",
	         	url: 'getDoctorInfoForSubmition',
	         	data: {id: id},
				success: function(msg) {
						var dates = "";
						for (var i = 0; i < msg.length; i++) {
						    dates += "<option value='"+ msg[i] +"'>"+ msg[i] +"</option>";
						}
						$("#dateAppointment").html(dates);
				},
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
				}
	    	 });
		});
	});
	$(".logOutMedic").click(function(){
		$.ajax({
	        	type: "POST",
	         	url: 'logOutMedic',
				success: function(msg) {
						window.location.reload();
				},
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
				}
	     });
	});
	$("#submitLoginDataMedic").click(function(){
		var login = $("#loginLog").val();
		var password = $("#passwordLog").val();
		var isCorrect = true;
		if(login.length < 3){
			isCorrect = false;
			$("#messageLoginLog").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Login must be more then 3 symbols.</div>");
		}else{
			$("#messageLoginLog").html("<br>");
		}
		if(password.length < 3){
			isCorrect = false;
			$("#messagePasswordLog").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Password must be more then 3 symbols.</div>");	
		}else{
			$("#messagePasswordLog").html("<br>");
		}
		if(!isCorrect)
			return;
		$.ajax({
	        	type: "POST",
	         	url: 'loginMedic',
				data: {login: login, password: password}, 
				success: function(msg) {
					var obj = jQuery.parseJSON(msg);
					if(obj.success == 0){
						$('.btn-default').click();
						window.location.reload();
					}
					else if( obj.success == 1 ){
						$("#messageLoginLog").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Login or Password did not presented into database</div>");
					}
		        },
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
				}
	     });
	});
	$(function(){
		$("#submitRegDataMedic").click(function(){
			var name = $("#name").val();
			var email = $("#email").val();
			var password = $("#password").val();
			var login = $("#login").val();
			var standing = $("#standing").val();
			var phone = $("#tel").val();
			var characteristic = $("#characteristic").val();
			var specialty = $("#specialty").val();
			var isCorrect = true;
			// alert(name + email + password + login + standing + phone + characteristic + specialty);
			if(standing.length == ''){
		  		isCorrect = false;
				$("#messageStanding").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Standing don`t presented</div>");
			}else{
				$("#messageStanding").html("<br>");
			}
			var regexpPhone = new RegExp("^[0-9]{10}$");
			if(phone.length == '' || !regexpPhone.test(phone)){
				isCorrect = false;
				$("#messageTel").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Please, provide a valid phone number.</div>");
			}else{
				$("#messageTel").html("<br>");
			}
			if(characteristic.length == 0){
				isCorrect = false;
				$("#messageCharacteristic").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Please, provide a characteristic.</div>");
			}else{
				$("#messageCharacteristic").html("<br>");
			}
			var regexName = new RegExp("^[a-zA-Z ]+$");
			if(name.length < 3 || !regexName.test(name)){
		  		isCorrect = false;
				$("#messageName").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Please provide a valid name.</div>");
			}else{
				$("#messageName").html("<br>");
			}
			if(login.length < 3){
		  		isCorrect = false;
				$("#messageLogin").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Login must be more then 3 symbols.</div>");
			}else{
				$("#messageLogin").html("<br>");
			}
			if(password.length < 3){
				isCorrect = false;
				$("#messagePassword").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Password must be more then 3 symbols.</div>");	
			}else{
				$("#messagePassword").html("<br>");
			}
			var re = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/; 
			if (email == '' || !re.test(email)){
				isCorrect = false;
				$("#messageEmail").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong>Please provide a valid email address</div>");		
			}else{
				$("#messageEmail").html("<br>");
			} 
			if(!isCorrect)
				return;
			$.ajax({
	        	type: "POST",
	         	url: 'regMedic',
				data: {name: name, email: email, 
					password: password, characteristic: characteristic, 
					specialty: specialty, login: login,
					standing: standing, phone: phone},
				success: function(msg) {
					if(msg == 0){
						$('.btn-default').click();
					}
					else{
						var obj = jQuery.parseJSON(msg);
						if( obj.log != "" )
							$("#messageLogin").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> "+obj.log+"</div>");
						if(obj.mail != "")	
							$("#messageEmail").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> "+obj.mail+"</div>");
					}
		        },
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
				}
	        });
		});
	});
	$(function(){
		$("#postNews").click(function(){
			var news = $("#news").val();
			var title = $("#titles").val();
			var isCorrect = true;
			if(title.length < 1){
		  		isCorrect = false;
				$("#messageTitle").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Title must be more then 3 symbols.</div>");
			}else{
				$("#messageTitle").html("");
			}
			if(news.length < 1){
				isCorrect = false;
				$("#messageNews").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> News must be more then 3 symbols.</div>");	
			}else{
				$("#messageNews").html("");
			}
			if(!isCorrect)
				return;
			$.ajax({
	        	type: "POST",
	         	url: 'publicNews',
				data: {title: title, news: news},
				success: function(msg) {
		        },
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
				}
	        });
		});
	});
	$(function(){
		$("#submitSupportLoginData").click(function(){
			var login = $("#loginSupport").val();
	 		var password = $("#passwordSupport").val();
	 		var isCorrect = true;
		  	if(login.length < 3){
		  		isCorrect = false;
				$("#messageLoginSupport").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Login must be more then 3 symbols.</div>");
			}else{
				$("#messageLoginSupport").html("<br>");
			}
			if(password.length < 3){
				isCorrect = false;
				$("#messagePasswordSupport").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Password must be more then 3 symbols.</div>");	
			}else{
				$("#messagePasswordSupport").html("<br>");
			}
			if(!isCorrect)
				return;
			$.ajax({
	        	type: "POST",
	         	url: 'loginSupport',
				data: {login: login, password: password},
				success: function(msg) {
					var obj = jQuery.parseJSON(msg);
					if(obj.success == 0){
						$('.btn-default').click();
						window.location.reload();
					}
					else if( obj.success == 1 ){
						$("#messageLoginSupport").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Login or Password did not presented into database</div>");
					}
		        },
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
	     		}
	        });
		});
	});
	$(function(){
		$(".supportModalLogOut").click(function(){
			$.ajax({
	        	type: "POST",
	         	url: 'logOutSupport',
				success: function(msg) {
					window.location.reload();
		        },
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
	     		}
	        });
		});
	});
	$(function(){
	  	$(".logOut").click(function(){
	  		$.ajax({
	        	type: "POST",
	         	url: 'logOutPatient',
				success: function(msg) {
					window.location.reload();
	            },
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
	     		}
	        }); 
	  	});
	});
	$(function(){
		$("#postMention").click(function(){
			var comment = $("#commentArea").val();
			var valuation = $("#valuation").val();
	  		$.ajax({
	        	type: "POST",
	         	url: 'reviews/postMention',
				data: {comment: comment, valuation: valuation},
				success: function(msg) {
					var obj = jQuery.parseJSON(msg);
					$("#commentBlock").prepend("<div class='col-sm-10'><h4> " + obj.login
					 + "<small>" 
					 +" "+ obj.date + "</small></h4><h5><span class='label label-danger'>Valuation: </span><span class='label label-primary'>"
					 + " "+obj.valuation + "</span></h5><p>" + obj.comment + "</p><br></div>");	
	            },
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
	     		}
	        }); 
	  	});
	});
	 $(function(){
	  	$("#submitRegData").click(function(e) { 	
		  	var login = $("#logins").val();
		  	var name = $("#names").val();
		  	var password = $("#passwords").val();
		  	var email = $("#emails").val();
		  	var age = $("#ages").val();
		  	var isCorrect = true;
		  	if(login.length < 3){
		  		isCorrect = false;
				$("#messageLogin").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Login must be more then 3 symbols.</div>");
			}else{
				$("#messageLogin").html("<br>");
			}
		  	if(name.length < 3){
		  		isCorrect = false;
				$("#messageName").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Name must be more then 3 symbols.</div>");
			}else{
				$("#messageName").html("<br>");
			}
			if(password.length < 3){
				isCorrect = false;
				$("#messagePassword").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Password must be more then 3 symbols.</div>");	
			}else{
				$("#messagePassword").html("<br>");
			}
			var re = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/; 
			if (email == '' || !re.test(email)){
				isCorrect = false;	
				$("#messageEmail").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong>Please provide a valid email address</div>");		
			}else{
				$("#messageEmail").html("<br>");
			} 
			if(age.length == ''){
				isCorrect = false;
				$("#messageAge").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong>Please provide age</div>");		
			}else{
				$("#messageAge").html("<br>");
			} 
			if(!isCorrect)
				return;
		 	$.ajax({
	        	type: "POST",
	         	url: 'postRegistration',
				data: {login: login, password: password, email: email, age: age, name: name},
				success: function(msg) {
					if(msg == 0){
						$('.btn-default').click();
					}
					else{
						var obj = jQuery.parseJSON(msg);
						if( obj.log != "" )
							$("#messageLogin").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> "+obj.log+"</div>");
						if(obj.mail != "")	
							$("#messageEmail").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> "+obj.mail+"</div>");
					}
	            },
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
	     		}
	        }); 				
		});
	});
	 $(function(){
	 	$("#submitLoginData").click(function(){
	 		var login = $("#loginLog").val();
	 		var password = $("#passwordLog").val();
	 		var isCorrect = true;
		  	if(login.length < 3){
		  		isCorrect = false;
				$("#messageLoginLog").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Login must be more then 3 symbols.</div>");
			}else{
				$("#messageLoginLog").html("<br>");
			}
			if(password.length < 3){
				isCorrect = false;
				$("#messagePasswordLog").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Password must be more then 3 symbols.</div>");	
			}else{
				$("#messagePasswordLog").html("<br>");
			}
			if(!isCorrect)
				return;
	 		$.ajax({
	        	type: "POST",
	         	url: 'loginPatient',
				data: {login: login, password: password},
				success: function(msg) {
					var obj = jQuery.parseJSON(msg);
					if(obj.success == 0){
						$('.btn-default').click();
						window.location.reload();
					}
					else if( obj.success == 1 ){
						$("#messageLoginLog").html("<br><div class='alert alert-danger alert-dismissable'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a><strong>Danger!</strong> Login or Password did not presented into database</div>");
					}
	            },
	            error:function(){  
					alert("Woops, we have some problems. Sorry");     
	     		}
	        }); 		
	 	});
	 });
});
