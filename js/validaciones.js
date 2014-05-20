$(function(){
	$.validator.addMethod("mail", function(value, element){
		return this.optional(element) || /^([^.@]+)(\.[^.@]+)*@([^.@]+\.)+([^.@]+)/i.test(value);
	}, "Debe ingresar un correo valido");

	$.validator.addMethod("passwordv",function(value,element) {
		return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{3,20}$/i.test(value); 
	},"La contraseña debe contener entre 3 y 20 caracteres");

	$.validator.addMethod("username",function(value,element) {
		return this.optional(element) || /^[a-zA-Z0-9._-]{3,30}$/i.test(value); 
	},"Ingrese un nombre de usuario valido");


	$("#form-login").validate({
		rules: {
			usermail: {
				required: true,
				minlength: 3
			},
			passwd: {
				required: true,
				minlength: 3,
				maxlength: 20
			}
		},
		messages: {
			usermail:{
				required: "<span class='merror'>Debe ingresar un correo o nombre de usuario</span>",
				minlength: "<span class='merror'>el nombre de usuario debe tener mas de 3 caracteres</span>"
			},
			passwd: {
				required: "<span class='merror'>Debe ingresar una contraseña</span>",
				minlength: "<span class='merror'>El nombre de usuario debe tener mas de 3 caracteres</span>",
				maxlength: "<span class='merror'>El nombre de usuario no puede exceder los 20 caracteres</span>"
			}
		}
	});


	$("#form-registro").validate({
		rules: {
			nombre: {
				required: true,
				minlength: 3,
				maxlength: 100
			},
			usuario: {
				required: true,
				minlength: 3,
				maxlength: 30,
				username: true
			},
			email: {
				required: true,
				mail: true
			},
			veremail: {
				required: true,
				equalTo: "#email"
			},
			passwd: {
				required: true,
				minlength: 3,
				maxlength: 20
			},
			verpasswd: {
				required: true,
				equalTo: "#passwd"
			}
		},
		messages: {
			nombre: {
				required: "<span class='merror'>Debe ingresar un nombre</span>",
				minlength: "<span class='merror'>El nombre debe tener mas de 3 caracteres</span>",
				maxlength: "<span class='merror'>El nombre no puede exceder los 100 caracteres</span>"
			},
			usuario: {
				required: "<span class='merror'>Debe ingresar un nombre de usuario</span>",
				minlength: "<span class='merror'>El nombre de usuario debe tener mas de 3 caracteres</span>",
				maxlength: "<span class='merror'>El nombre de usuario no puede exceder los 30 caracteres</span>",
				username: "<span class='merror'>no debe poseer caracteres especiales</span>"
			},
			email: {
				required: "<span class='merror'>Debe ingresar un correo electronico</span>",
				mail: "<span class='merror'>Correo electronico invalido</span>"
			},
			veremail: {
				required: "<span class='merror'>Debe Re-ingresar el correo electronico</span>",
				equalTo: "<span class='merror'>El correo electronico no coincide</span>"
			},
			passwd: {
				required: "<span class='merror'>Debe ingresar una contraseña</span>",
				minlength: "<span class='merror'>El nombre de usuario debe tener mas de 3 caracteres</span>",
				maxlength: "<span class='merror'>El nombre de usuario no puede exceder los 20 caracteres</span>"
			},
			verpasswd: {
				required: "<span class='merror'>Debe Re-ingresar la contraseña</span>",
				equalTo: "<span class='merror'>La contraseña no coincide</span>"
			}

		}
	});


	$(".toolti").tooltip();
});