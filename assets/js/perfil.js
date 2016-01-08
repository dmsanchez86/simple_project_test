function cambiaNavegacion(idSeccion,boton)
{
    $(".navegacion").addClass("oculto");
    $("#"+idSeccion).removeClass("oculto");
    $(".navegacion-boton").removeClass("active");
    $(boton).addClass("active");
}
function activaEventos()
{
    //eventos de navegacion
    $("#biografiaNav").on("click",function(){cambiaNavegacion("biografia",this)});
    $("#configuracionNav").on("click",function(){cambiaNavegacion("configuracion",this)});
    $("#tokensNav").on("click",function(){cambiaNavegacion("tokens",this)});
    $("#favoritosNav").on("click",function(){cambiaNavegacion("favoritos",this)});
    $("#eventosNav").on("click",function(){cambiaNavegacion("eventos",this)});
    $("#ayudaNav").on("click",function(){cambiaNavegacion("ayuda",this)});
    $("#galeriaNav").on("click",function(){cambiaNavegacion("mi-galeria",this)});
    //choosen
    $(".chooseable").chosen({
        "width": "100%",
        "no_results_text": "No se ha encontrado ningun pais/idioma",
        //html_template: '<img style="border:3px solid black;padding:0px;margin-right:4px; width: 10%;heigth: 60px;" class="{class_name}" src="{url}">'
    });
    $("#precio-box").on("click",function(){
        if ($("#precio-input").is("[disabled]"))
        {
            $("#precio-input").removeAttr("disabled");
        }
        else
        {
            $("#precio-input").prop("disabled",true);
        }
    });
    //configuracion show
    var bloqueaFunc=function(){
        $(".paises-bloqueados").append(this);
        $(this).on("click",desbloqueaFunc);
        $(this).addClass("pais-bloqueado");
        $(this).removeClass("pais-bloqueable");
    };
    var desbloqueaFunc=function(){
      $(".paises-bloqueables").append(this);
      $(this).on("click",bloqueaFunc);
      
        $(this).addClass("pais-bloqueable");
        $(this).removeClass("pais-bloqueado");
      
      $(".pais-bloqueado").prop("selected","selected");
    };
    $(".pais-bloqueable").on("click",bloqueaFunc);
    $(".pais-bloqueado").on("click",desbloqueaFunc);
}
function webCam()
{
// Put event listeners into place
		$("#iniciar-cam").on("click",function(){
			// Grab elements, create settings, etc.
			var canvas = document.getElementById("canvas"),
				context = canvas.getContext("2d"),
				video = document.getElementById("video"),
				videoObj = { "video": true },
				errBack = function(error) {
					console.log("Video capture error: ", error.code); 
				};

			// Put video listeners into place
			if(navigator.getUserMedia) { // Standard
				navigator.getUserMedia(videoObj, function(stream) {
					video.src = stream;
					video.play();
				}, errBack);
			} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
				navigator.webkitGetUserMedia(videoObj, function(stream){
					video.src = window.webkitURL.createObjectURL(stream);
					video.play();
				}, errBack);
			} else if(navigator.mozGetUserMedia) { // WebKit-prefixed
				navigator.mozGetUserMedia(videoObj, function(stream){
					video.src = window.URL.createObjectURL(stream);
					video.play();
				}, errBack);
			}

			// Trigger photo take
			$("#snap").on("click", function() {
				context.drawImage(video, 0, 0, 300, 350);
                                
                                var data = canvas.toDataURL('image/png');
                                var xhr = new XMLHttpRequest();
                                xhr.onreadystatechange = function() {
                                  // request complete
                                  if (xhr.readyState == 4) {
                                    $("#imagenPerfil").attr("src",xhr.responseText);
                                    console.log(xhr.responseText);
                                  }
                                }
                                xhr.open('POST','../Controler/AJAX/FotoPerfil.php',true);
                                xhr.setRequestHeader('Content-Type', 'application/upload');
                                xhr.send(data);
                                /*$.ajax({
                                url: "../Controler/AJAX/FotoPerfil.php",
                                type: 'POST',
                                dataType: "html",
                                contentType: "application/upload",
                                "data": {"foto": data},
                                "success": function(respuesta)
                                    {
                                        alert(respuesta);
                                    },
                                error: function(e,d){console.log("algo falló al subir la foto de perfil. :("+d);}
                            });*/
			});
		});
}
function compruebaSubirFoto()
{
    
}
function perfil()
{
    activaEventos();
    webCam();
}
$(perfil);