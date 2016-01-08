function basico()
{
    $("img").on("error",function(){$(this).attr("src","../GaleriaLubriCam/foto-perfil-defecto.jpg")});
}
$(basico);
