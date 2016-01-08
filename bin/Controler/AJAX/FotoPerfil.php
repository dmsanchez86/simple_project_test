<?php
session_start();
require_once '../lib/BD.php';
require_once '../lib/Utilidades.php';
sesionBasica();
if (isset($_SESSION["nick"]))
{
    //echo $_SESSION["nick"]."<br/>";
    $data = file_get_contents("php://input");
        // filtering and decoding code adapted from
            // http://stackoverflow.com/questions/11843115/uploading-canvas-context-as-image-using-ajax-and-php?lq=1
        // Filter out the headers (data:,) part.
        $filteredData=substr($data, strpos($data, ",")+1);
        // Need to decode before saving since the data we received is already base64 encoded
        $decodedData=base64_decode($filteredData);
        // store in server
        $fic_name = 'fotoperfil'.rand(1000,9999).'.png';
        $fp = fopen(GALERIAAJAX."/$nick/".$fic_name, 'wb');
        $ok = fwrite( $fp, $decodedData);
        fclose( $fp );
        
        //elimina foto anterior (si la hay) base datos y fichero
        $imagenAnterior=getSelectP2("select lubri_imagenes.* from lubri_imagenes inner join lubri_usuarios on lubri_imagenes.id=lubri_usuarios.id_imagen_perfil")[0];
        //echo var_dump($imagenAnterior);
        if (isset($imagenAnterior["id"]))
        {
            getSelectP2("delete from lubri_imagenes where id=?",$imagenAnterior["id"]);
            unlink(GALERIAAJAX."/$nick/".$imagenAnterior["url"]);
        }
        //inserta foto base datos
        getSelectP2("insert into lubri_imagenes (id_usuario_creador,fecha_creacion,url) values (?,?,?)",$idUsuario,getFechaTime(),$fic_name);
        getSelectP2("update lubri_usuarios set id_imagen_perfil=? where id=?",lastID(),$idUsuario);
        if($ok)
            echo GALERIAVISTA."/$nick/".$fic_name;
        else
            echo "ERROR";
}
else
{
    echo "Ocurrió un fallo con su cuenta";
}