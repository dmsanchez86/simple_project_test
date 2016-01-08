<?php
require_once 'BD.php';
const GALERIAVISTA="../GaleriaLubriCam";
const GALERIACONTROLER="../GaleriaLubriCam";
const GALERIAAJAX="../../GaleriaLubriCam";
const RECURSIVO=true;
/**
 * Devuelve true si el usuario está logueado
 * false en caso contrario
 * @return boolean
 */
function estaLogueado()
{
    session_start();
    return isset($_SESSION["nick"]);
}
/**
 * Redirige a una ruta especificada
 * @param string $url
 */
function redirige($url)
{
    echo '<script> location.replace("'.$url.'"); </script>';
}
/**
 * en caso de que getruta con este formato ?ruta=nombrefichero
 * se enviara via get (esto se usa para que el login sepa donde queria acceder antes de loguearse el usuario)
 * si El usuario no está logueado lo redirige al login2.php
 * a no ser que se le de como parametro otra ruta
 */
function checkAccess($getruta="",$ruta="Registro.php")
{
    if (!estaLogueado())
        redirige($ruta.$getruta);
}
/**
 * Devuelve el id del usuario de la sesion actual
 * util para hacer operaciones de BD que requieran
 * el id de usuario en lugar de su nick.
 * @return string
 */
function getIdUserSession()
{
    session_start();
    return getIdFromNick($_SESSION["nick"]);
}
function getIdFromNick($nick)
{
    $idUsuario=getSelectP2Assoc("select id from lubri_usuarios where nick=?",$nick);
    $idUsuario=$idUsuario[0]["id"];
    return $idUsuario;
}
function estaMultiArray($campo,$matriz)
{
    foreach ($matriz as $fila)
        foreach($fila as $columna)
            if ($columna==$campo)
                return true;
    return false;
}
function sonAmigos($idUsuario1,$idUsuario2)
{
    $amigos=getSelectP2("select * from amigos where (id1=? and id2=?) OR (id1=? and id2=?)",
            $idUsuario1,$idUsuario2,$idUsuario2,$idUsuario1);
    return isset($amigos[0][0]);
}
function enviaronPeticionAmistad($idUsuario1,$idUsuario2)
{
    $peticionAmistad=getSelectP2("select * from solicitudesAmistad where"
            . " (id_emisor=? and id_receptor=?) OR (id_emisor=? and id_receptor=?)",
            $idUsuario1,$idUsuario2,$idUsuario2,$idUsuario1);
    return isset($peticionAmistad[0][0]);
}
/**
 * Recibe el id de un usuario como parametro
 * y devuelve un array con sus amigos
 * @param int $idUsuario
 * @return array  con nick de usuarios
 */
function getAmigos($idUsuario)
{
    //obtenemos el nick del usuario
    $nickUsuario=getSelectP2("select nick from usuarios where id=?",$idUsuario);
    $nickUsuario=$nickUsuario[0]["nick"];
    //echo "/nick: /".$nickUsuario." /id:/".$idUsuario;
    //obtenemos sus amigos
    $amigos=getSelectP2("select usuarios.id,nick from usuarios"
                        ." where (usuarios.id = ANY (select id1 from amigos where id1=? or id2=?)"
                        ." or usuarios.id = ANY (select id2 from amigos where id1=? or id2=?))"
                        ." and usuarios.id!=?"
                        ,$idUsuario,$idUsuario,$idUsuario,$idUsuario,$idUsuario);
    //echo var_dump($amigos);
    $listaAmigos=array();
    //obtenemos los amigos sin repetir
    for ($f=0,$i=0,$c=count($amigos);$f<$c;$f++)
    {
        if (!in_array($amigos[$f]["nick"], $listaAmigos))
        {
            $listaAmigos[$i]=$amigos[$f]["nick"];
            $i++;
        }
    }
    //ahora a los amigos les añadimos la foto de perfil
    $listaCompleta=array();
    for ($f=0,$c=count($listaAmigos);$f<$c;$f++)
    {
        $idAmigo=getSelectP2("select id from usuarios where nick=?",$listaAmigos[$f]);
        $idAmigo=$idAmigo[0]["id"];
        $descripcionAmigo=getSelectP2("select descripcion from datosPersonales where id_usuario=?",$idAmigo);
        $descripcionAmigo=$descripcionAmigo[0]["descripcion"];
        
        $perfilUsuario=getSelectP2("select fotos.url from fotos inner join fotosPerfil on fotos.id=fotosPerfil.id_foto where fotosPerfil.activo=1 and fotosPerfil.id_usuario=? limit 1",$idAmigo);
        $perfilUsuario=$perfilUsuario[0];
        
        $listaCompleta[$f]["nick"]=$listaAmigos[$f];
        $listaCompleta[$f]["descripcion"]=$descripcionAmigo;
        if ($perfilUsuario!=null)
        {
            $listaCompleta[$f]["urlfotoperfil"]="JustStrongFiles/Usuarios/$idAmigo/fotos/{$perfilUsuario["url"]}";
        }
        else
        {
            $listaCompleta[$f]["urlfotoperfil"]="JustStrongFiles/default/fotodefault.jpg";
        }
    }
    //echo var_dump($listaCompleta);
    return $listaCompleta;
}
function anadeFotoPerfilListaUsuarios(&$listaUsuarios,$discriminante="id")
{
    for ($f=0,$c=count($listaUsuarios);$f<$c;$f++)
    {
        $perfilUsuario=getSelectP2("select fotos.url as url from fotos inner join fotosPerfil on fotos.id=fotosPerfil.id_foto where fotosPerfil.activo=1 and fotosPerfil.id_usuario=? limit 1",$listaUsuarios[$f][$discriminante]);
        $perfilUsuario=$perfilUsuario[0]["url"];
        if ($perfilUsuario!=null)
        {
            $listaUsuarios[$f]["urlfotoperfil"]="JustStrongFiles/Usuarios/{$listaUsuarios[$f][$discriminante]}/fotos/{$perfilUsuario}";
        }
        else
        {
            $listaUsuarios[$f]["urlfotoperfil"]="JustStrongFiles/default/fotodefault.jpg";
        }
    }
}
function eliminaAmistad($id1,$id2)
{
    getSelectP2("delete from amigos where (id1=? and id2=?) or (id1=? and id2=?)"
            ,$id1,$id2,$id2,$id1);
    getSelectP2("delete from solicitudesAmistad where (id_emisor=? and id_receptor=?) or (id_emisor=? and id_receptor=?)"
            ,$id1,$id2,$id2,$id1);
}
function verificarDato($nombreDato,$valorDato,$longitudMinima,$longitudMaxima,$null=NULO,$patron="",$mensajePatron="")
    {
        global $errores;global $datosOK;
        $errores[$nombreDato]="";
        if ($null==NONULO&&$valorDato=="")
        {
            $errores[$nombreDato].="<div>El campo $nombreDato no debe estar vacio</div>";
            $datosOK=false;
        }
        if (strlen($valorDato)>$longitudMaxima||strlen($valorDato)<$longitudMinima)
        {
            $errores[$nombreDato].="<div>Logitud de campo $nombreDato debe estar entre $longitudMinima y $longitudMaxima </div>";
            $datosOK=false;
        }
        if ($patron!="")
        {
            if (!preg_match($patron,$valorDato))
            {
                $errores[$nombreDato].="<div>El campo $nombreDato $mensajePatron</div>";
                $datosOK=false;
            }
        }
        if ($nombreDato=="password")
        {
            if ($valorDato!=$_POST["password2"])
            {
                $errores[$nombreDato].="<div>Las contraseñas deben ser iguales</div>";
                $datosOK=false;
            }
        }
    }
    function getSpanishDate($date)
    {
        $date=new DateTime($date);
        $date=$date->format("d/m/Y");
        return $date;
    }
    function getSpanishDateTime($date)
    {
        $date=new DateTime($date);
        $date=$date->format("H:i d/m/Y");
        return $date;
    }
    $nick="";
    $idUsuario="";
    function sesionBasica()
    {
        global $nick;global $idUsuario;
        session_start();
        $nick=$_SESSION["nick"];
        $idUsuario=getIdUserSession();
    }
    /**
     * a partir de una fecha en formato yyyy-mm-dd
     * devuelve la edad representada en un entero
     * return int edad
     */
function CalculaEdad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}
function getFecha()
{
    return date("Y-m-d");
}
function getFechaTime()
{
    return date("Y-m-d H:i:s");
}
function protegerImagen($urlImagen,$urlDestino,$urlImagenAgua="../assets/imagenes/candado.png")
{
    // Cargar la estampa y la foto para aplicarle la marca de agua
    $imagenAgua = imagecreatefrompng($urlImagenAgua);
    $imagen = imagecreatefromjpeg($urlImagen);

    $size=getimagesize($urlImagen);
    $x=$size[0]/2;
    $y=$size[1]/2;

    $wsize=  getimagesize($urlImagenAgua);
    $wx=$wsize[0]/2;
    $wy=$wsize[1]/2;
    
    //mezclamos las dos imagenes
    imagecopy($imagen,$imagenAgua,$x-$wx,$y-$wy,0,0,$wx*2,$wy*2);

    // Guardar la imagen en un archivo y liberar memoria
    if (imagepng($imagen, $urlDestino))
    {
        return true;
    }
    else
    {
        return false;
    }
}