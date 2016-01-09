
// carga de la pagina
$().ready(function(){
	// si no ha aceptado los terminos y condiciones
	if(localStorage.getItem('validate') != 'true')
	  $("#start").addClass('open_popup');

	// Evento que me muestra el popup del login
	$("#tip5").unbind('click').click(function(e){
	  e.preventDefault();
	  $('#login').addClass('open_popup');
	});

	// Evento que me muestra el popup del registro
	$("#regis").unbind('click').click(function(e){
	  e.preventDefault();
	  $('#register').addClass('open_popup');
	});

	// Evento que me muestra el popup del login
	$("#retras").unbind('click').click(function(e){
	  e.preventDefault();
	  $('#transmit').addClass('open_popup');
	});

	// evento que cierra el popup del login
	$('#login .close_pop').unbind('click').click(function(){
	  $('#login').removeClass('open_popup');
	});

	// evento que cierra el popup del registro
	$('#register .close_pop').unbind('click').click(function(){
	  $('#register').removeClass('open_popup');
	});

	// evento que cierra el popup de olvido de contraseña
	$('#forget_password .close_pop').unbind('click').click(function(){
	  $('#forget_password').removeClass('open_popup');
	});

	// evento que cierra el popup del trasnmitete
	$('#transmit .close_pop, #btn_go_out_transmit').unbind('click').click(function(){
	  $('#transmit').removeClass('open_popup');
	});

	// evento que cierra el popup del temporizador 1
	$('#temp1 .close_pop').unbind('click').click(function(){
	  $('#temp1').removeClass('open_popup');
	});

	// evento que cierra el popup del temporizador 2
	$('#temp2 .close_pop').unbind('click').click(function(){
	  $('#temp2').removeClass('open_popup');
	});

	// evento que cierra el popup de cuando inicia sesion
	$('#log_in .close_pop, #btn_thanks').unbind('click').click(function(){
		$('#log_in').removeClass('open_popup');
		localStorage.setItem('first_popup', true);
	});

	// evento del boton del temporizador 1
	$('#btn_register_alias').unbind('click').click(function(){
	  $("#temp1").removeClass('open_popup');

	  setTimeout(function(){ $("#login").addClass('open_popup'); }, 120);
	});

	// evento del boton del temporizador 1
	$('#btn_charge').unbind('click').click(function(){
	  if(localStorage.getItem('log') == null)
	  	$("#login").addClass('open_popup');
	  else
	  	window.location = "?m=33";
	});

	// evento del formulario
	$('#login_form').unbind('submit').submit(function(e){
	  e.preventDefault();

	  var alias = $('#login_name').val();
	  var password = $('#login_pass').val();

	  if(alias == "" ){
	    $('#login_name').focus();
	  }else if(password == ""){
	    $('#login_pass').focus();
	  }else{
	    // se hace el ajax para iniciar sesion
	    $.ajax({
	      url: 'inicio.php',
	      type: 'POST',
	      data: {
	        usuario: alias,
	        clave: password,
	        acceso: true,
	        login: true
	      },
	      success: function(res){
	        if(res == 'FILE2'){
	          alert('¡Los Datos Ingresados no existen en la base de datos!');
	        }else if(res == "FAIL"){
	          alert('¡Los Datos Ingresados son incorrectos!');
	        }else if(res == 'OK'){ // si todo esta bien recargo la pagina
	          location.reload();
	          localStorage.setItem('log', true);
	        }
	      }
	    });
	  }
	});

	// Evento del popup del loggin
	$('#btn_login').unbind('click').click(function(){
	  $('#login_form').submit();
	});

	// Evento de salir cuando acepta que no tiene 18 años
	$('#btn_go_out').unbind('click').click(function(){
	  window.location = "http://google.com";
	});

	// Evento que dirige a recargar los tokens
	$('#btn_recharge_tokens').unbind('click').click(function(){
	  window.location = "?m=33";
	});

	// evento del boton ingresar 
	$('#btn_enter').unbind('click').click(function(){
	  var checked = $("#accept_terms:checked"); 

	  if(checked.length > 0){ // si el checkbox esta checkeado
	    $("#start").removeClass('open_popup');
	    localStorage.setItem('validate', true);
	  }else{
	    $("#accept_terms").focus();
	  }
	});

	// evento del boton ingresar de tranmitirte
	$('#btn_enter_transmit').unbind('click').click(function(){
	  if(localStorage.getItem('log') == null){
	  	$("#login").addClass('open_popup');
	  	$('#transmit').removeClass('open_popup');
	  }
	  else
	  	alert();
	});

	// evento del link de login hacia el registro
	$('a[href="#register"]').unbind('click').click(function(e){
	  e.preventDefault();e
	  $("#login, #forget_password").removeClass('open_popup');

	  setTimeout(function(){ $("#register").addClass('open_popup'); }, 120);
	});

	// evento del link de register hacia el login
	$('a[href="#login"]').unbind('click').click(function(e){
	  e.preventDefault();
	  $("#register").removeClass('open_popup');

	  setTimeout(function(){ $("#login").addClass('open_popup'); }, 120);
	});

	// evento del link de register hacia el login
	$('a[href="#forgot_password"]').unbind('click').click(function(e){
	  e.preventDefault();
	  $("#login").removeClass('open_popup');

	  setTimeout(function(){ $("#forget_password").addClass('open_popup'); }, 120);
	});

	// evento que vuelve del olvido de contraseña al login
	$('a[href="#back_login"]').unbind('click').click(function(e){
	  e.preventDefault();e
	  $("#forget_password").removeClass('open_popup');

	  setTimeout(function(){ $("#login").addClass('open_popup'); }, 120);
	});

	// Evento a los links que dirijan a terminos y condiciones
	$('a[href="#terms"]').unbind('click').click(function(e){
		e.preventDefault();
		$("#log_in").removeClass('open_popup');

	  	setTimeout(function(){ $("#terms").addClass('open_popup'); }, 120);

		// evento que cierra el popup de los terminos
		$('#terms .close_pop').unbind('click').click(function(){
			$('#terms').removeClass('open_popup');
		});

		// Evento cuando lee los terminos y condiciones
		$('#btn_read').unbind('click').click(function(){

			$("#terms").removeClass('open_popup');

			setTimeout(function(){ $("#log_in").addClass('open_popup'); }, 120);
		});
	});

	// click en el popup de terminos y condiciones del inicio
	$('#accept_terms + label b').unbind('click').click(function(){
	  $("#start").removeClass('open_popup');

	  setTimeout(function(){ $("#terms").addClass('open_popup'); }, 120);

	  // evento que cierra el popup de los terminos
	  $('#terms .close_pop').unbind('click').click(function(){
	    $('#terms').removeClass('open_popup');

	    setTimeout(function(){ $("#start").addClass('open_popup'); }, 120);
	  });

	  // Evento cuando lee los terminos y condiciones
	  $('#btn_read').unbind('click').click(function(){
	    document.querySelector('#accept_terms').checked = true;

	    $("#terms").removeClass('open_popup');

	    setTimeout(function(){ $("#start").addClass('open_popup'); }, 120);
	  });
	});

	// click en el popup de terminos y condiciones del popup de registro
	$('#accept_terms_register + label b').unbind('click').click(function(){
	  $("#register").removeClass('open_popup');

	  setTimeout(function(){ $("#terms").addClass('open_popup'); }, 120);

	  // evento que cierra el popup de los terminos
	  $('#terms .close_pop').unbind('click').click(function(){
	    $('#terms').removeClass('open_popup');

	    setTimeout(function(){ $("#register").addClass('open_popup'); }, 120);
	  });

	  // Evento cuando lee los terminos y condiciones
	  $('#btn_read').unbind('click').click(function(){
	    document.querySelector('#accept_terms_register').checked = true;

	    $("#terms").removeClass('open_popup');

	    setTimeout(function(){ $("#register").addClass('open_popup'); }, 120);
	  });
	});
});