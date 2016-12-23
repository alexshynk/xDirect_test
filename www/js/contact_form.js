function faccept(){
	if (document.getElementById("i_accept").checked) {
		document.getElementsByName("send")[0].disabled = false;
	}
	else document.getElementsByName("send")[0].disabled = true;
}

$(document).ready(function(){
	$("#contact_form").validate({
		rules:{
			name:{
				required: true,
				maxlength: 20
			},
			surname:{
				required: true,
				maxlength: 20
			},
			phone:{
				required: true,
				minlength: 3,
				maxlength: 15
			},
			email:{
				required: true,
				email: true
			}
			
		},
		
		messages: {
			name:{
				required: "Поле 'Имя' обязательно для ввода",
				maxlength: "Поле 'Имя' не более 30-ти символов"
			},
			surname:{
				required: "Поле 'Фамилия' обязательно для ввода"
			},
			phone:{
				required: "Поле 'Телефон' обязательно для ввода",
				minlength: "Поле 'Телефон' не менее 3-х символов",
				maxlength: "Поле 'Телефон' не более 15-ти символов"
			},
			email:{
				required: "Поле 'E-mail' обязательно для ввода",
				email: "Не верный E-mail"
			}		
			
		},
		
		errorPlacement: function(error, element){
			error.appendTo($(".err_msg").eq(0));
			$("<br>").appendTo($(".err_msg").eq(0));
		}
	});
	
	faccept();
	document.getElementById("i_accept").addEventListener("change",faccept);
	
})

function fsend_contact(){
	$(".err_msg").eq(0).html("");;
	
	if (!$("#contact_form").valid()) return false;
	
	var name = document.getElementsByName("name")[0].value;
	var surname = document.getElementsByName("surname")[0].value;
	var phone = document.getElementsByName("phone")[0].value;
	var email = document.getElementsByName("email")[0].value;
	
	//alert(name+" : "+surname+" : " + phone + " : " + email);
	
	$.ajax({
		method: "GET",
		url: "php/send.php",
		data: {"name" : name, "surname" :  "surname", "phone" : phone, "email" : email},
		dataType: "html",
		async: false,
		success: function(data){
			if (data.indexOf("Поздравляем") != -1)
				document.getElementsByClassName("err_msg")[0].innerHTML = "<span style='color:blue;'>"+data+"</span>";
			else document.getElementsByClassName("err_msg")[0].innerHTML = data;
		}
		
	})
}