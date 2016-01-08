<?php
/**
 * 
 * @param type $min numero de caracteres generados minimo
 * @param type $max numero de caracteres generados maximo
 */
function aleatorio($longitud)
{
    //ord($min); devuelve a partir de un caracter un decimal asscii
    //chr($min); devuelve a partir de un asscii un caracter
    //$numero=random(0,255);
    $aleatorio="";
    for ($f=0;$f<$longitud;$f++)
    {
        $aleatorio.=chr(rand(65,90));
    }
    return $aleatorio;
}