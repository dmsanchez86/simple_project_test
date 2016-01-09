<?php
require_once 'lib/BD.php';
require_once 'lib/Utilidades.php';
session_start();
sesionBasica();
/**
 * Modifica datos del perfil de usuario
 * falta comprobar la veracidad de los paises e idioma y los limites de los campos tamaño etc
 */
if (isset($_POST["enviar"])){
    /*echo $_POST["dia"]."-".$_POST["mes"]."-".$_POST["ano"];
    echo "<br/>".$_POST["idioma"]."__".$_POST["pais"];
    echo "<br/>".$_POST["nombre"]."----".$_POST["localidad"];*/
    getSelectP2("update lubri_usuarios set nombre=?,localidad=?,id_idioma=?,id_pais=?,fecha_nacimiento=?,detalles=?,descripcion=? where id=?",
                $_POST["nombre"],$_POST["localidad"],$_POST["idioma"],$_POST["pais"],($_POST["ano"]."-".$_POST["mes"]."-".$_POST["dia"]),$_POST["detalles"],$_POST["descripcion"],$idUsuario);
}
else if (isset($_POST["configurar"])){
    //eliminamos los paises bloqueados que tuviera el usuario
    getSelectP2("delete from lubri_usuarios_paises_bloqueados where id_usuario=?",$idUsuario);
    //insertamos los paises bloqueados contenidos en el select de paises bloqueados
    echo var_dump($_POST["paises-bloqueados"]);
    if ($_POST["paises-bloqueados"]!=null)
    {
    foreach($_POST["paises-bloqueados"] as $paisID)
    {
        getSelectP2("insert into lubri_usuarios_paises_bloqueados (id_usuario,id_pais) values (?,?)",$idUsuario,$paisID);
        echo $paisID."<br/>";
    }
    }
}
else if (isset($_POST["subir-foto"]))
{
    //sacamos del array asociativo $_POST las variables
    extract($_POST);
    $free=($precioImagen<=0)?true:false;
    echo "$tituloImagen  ___ $precioImagen ___ $descripcionImagen ";
    move_uploaded_file($_FILES["imagen"]["tmp_name"], GALERIACONTROLER."/$nick/galeria_".$_FILES["imagen"]["name"]);
    if (!$free)
    {
        //si no es una imagen gratuita crearemos otra imagen pero con un candado para que no se pueda apreciar
        protegerImagen(GALERIACONTROLER."/$nick/galeria_".$_FILES["imagen"]["name"],GALERIACONTROLER."/$nick/galeria_lock_".$_FILES["imagen"]["name"]);
    }
    echo "subiendo foto";
    getSelectP2("insert into lubri_imagenes (id_usuario_creador,fecha_creacion,precio,titulo,descripcion,url) values (?,?,?,?,?,?)"
            ,$idUsuario,getFechaTime(),$precioImagen,$tituloImagen,$descripcionImagen,"galeria_".$_FILES["imagen"]["name"]);
}
$paisesBloqueados=getSelectP2("SELECT lubri_paises . *"
        . " FROM (lubri_usuarios INNER JOIN lubri_usuarios_paises_bloqueados pb ON lubri_usuarios.id = id_usuario)"
        . " INNER JOIN lubri_paises ON lubri_paises.id = pb.id_pais"
        . " WHERE pb.id_usuario=?"
        ,$idUsuario);
$usuario=getSelectP2("select * from lubri_usuarios where id=?",$idUsuario)[0];
$usuarioIdioma=getSelectP2("select lubri_idiomas.* from lubri_usuarios inner join lubri_idiomas on id_idioma=lubri_idiomas.id")[0];
$usuarioPais=getSelectP2("select lubri_paises.* from lubri_usuarios inner join lubri_paises on id_pais=lubri_paises.id")[0];
$paises=getSelectP2("select * from lubri_paises");
$idiomas=getSelectP2("select * from lubri_idiomas");
$fecha=explode("-",$usuario["fecha_nacimiento"]);
$edad=calculaEdad($usuario["fecha_nacimiento"]);
$fotoPerfil=$imagenAnterior=getSelectP2("select lubri_imagenes.* from lubri_imagenes inner join lubri_usuarios on lubri_imagenes.id=lubri_usuarios.id_imagen_perfil")[0];