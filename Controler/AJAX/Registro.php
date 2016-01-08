<?php
require_once "../lib/BD.php";
/**
 * Comprobar si existe un campo
 */
if (isset($_POST["existecampo"]))
{
    if ($_POST["campo"]!="")
        {
            if ($_POST["nombrecampo"]=="nick")
            {
                $existeCampo=getSelectP2("select count(*) as c from lubri_usuarios where nick=?",$_POST["campo"]);
                $existeCampo=$existeCampo[0]["c"];
            }
            else if ($_POST["nombrecampo"]=="correo")
            {
                $existeCampo=getSelectP2("select count(*) as c from lubri_usuarios where correo=?",$_POST["campo"]);
                $existeCampo=$existeCampo[0]["c"];
            }
        }
    echo $existeCampo;
}