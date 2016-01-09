function muestraExisteCampoBD(respuesta,campoBD,perror)
{
    var respuestaINT=parseInt(respuesta);
    if (respuestaINT>0)
    {
        //deberemos poner OK de alvaro a false para que js no deje registrar
        $("#"+perror).css("display","block");
        $("#"+perror).html(campoBD+" ya esta cogido, escriba otro");
    }
    else
    {
        $("#"+perror).css("display","none");
    }
}
function existeCampoBD(campoInput,campoBD,perror)
{
    $.ajax({
        url: "../Controler/AJAX/Registro.php",
        type: 'POST',
        dataType: "html",
        "data": {"nombrecampo": campoBD,"campo": $(campoInput).val(),"existecampo":true},
        "success": function(respuesta)
            {
                muestraExisteCampoBD(respuesta,campoBD,perror);
            },
        error: function(e,d){console.log("algo falló al buscar el/los usuarios. :("+d);}
    });
}
function registro()
{
    $("#nick").on("keyup",function(){
              existeCampoBD(this,"nick","errorNick");
          });
    $("#correo").on("keyup",function(){
              existeCampoBD(this,"correo","errorCorreo");
          });
    $("#registrarse").on("click",function(){cambiaLoginRegistro("registro")});
    $("#volver").on("click",function(){cambiaLoginRegistro("login")});
}
function cambiaLoginRegistro(cambio)
{
    if (cambio=="registro")
    {
        $("#registro").removeClass("oculto");
        $("#login").addClass("oculto");
    }
    else if (cambio=="login")
    {
        $("#login").removeClass("oculto");
        $("#registro").addClass("oculto");
    }
}
$(registro);