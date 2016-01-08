<?php
class panel
{

private $var1;
private $var2;
private $var3;
private $var4;
      function __construct($var1, $var2, $var3, $var4)
      {
               $this->var1 = $var1;
               $this->var2 = $var2;
               $this->var3 = $var3;
               $this->var4 = $var4;

      }
      function conectar($consult, $fila="1")
      {
include "bdEX.php";
$linkEX=ConectarEX("s18ea85d_lubricam");
//$result=mysql_query($consult,$linkEX);


if($fila == "0"){
$result=mysql_query($consult,$linkEX);
mysql_query($result);

}elseif($fila == "2"){
$result=mysql_query($consult,$linkEX);

                    if ($row = @mysql_fetch_array($result)){
                    $numTR = mysql_num_rows($result); return $numTR; }else{ return "ERROR"; }


}else{
$result=mysql_query($consult,$linkEX);
if ($row = @mysql_fetch_array($result)){ return $row[$fila]; }else{ return false;}
}
      }
      
      function veritokens($ident)
      {
// Mostrar listado de todos los usuarios
      
include "bdEX.php";
$linkEX=ConectarEX("s18ea85d_lubricam");







if(isset($_POST["guarda"])){
$tokens = $_POST["tokens"];
$correo = $_POST["correo"];

$resu1 = mysql_query("UPDATE creditos SET fichas = '$tokens' WHERE correo = '$correo'",$linkEX);

if ($resu1){ echo ("<h2 style='text-align:center; color:green;'>Guardado correctamente ($correo - $tokens Tokens)</h2>");
}else{ echo ("<h2>Error, no se ha podido guardar la informacion.</h2>"); }

}else{}



if(isset($_POST["eliminar"])){
$correo = $_POST["correo"];

$resu1 = mysql_query("DELETE FROM registro WHERE correo = '$correo'",$linkEX);


if($resu1){ echo ("<h2 style='text-align:center; color:green;'>La cuenta de: $correo ha sido eliminada definitivamente.</h2>");

@mysql_query("DELETE FROM creditos WHERE correo = '$correo'",$linkEX);
@mysql_query("DELETE FROM logeo WHERE correo = '$correo'",$linkEX);
@mysql_query("DELETE FROM perfil WHERE correo = '$correo'",$linkEX);
@mysql_query("DELETE FROM ultima_entrada WHERE correo = '$correo'",$linkEX);

}else{ echo ("<h2>Error, no se ha podido eliminar la cuenta de: $correo.</h2>"); }

}else{}


$result=mysql_query("select * from creditos",$linkEX);
//if (@$row = mysql_fetch_array($result)){
while (@$row = mysql_fetch_array($result)){


print <<<HERE
<form action="" method="post" name="formtok">

<div style="display: inline-block; margin-left:25px; min-width:350px; font-size:1.2em;"> $row[0]</div>
<div style="display: inline-block; ">TOKENS: <input type="text" name="tokens" value="$row[1]" style="font-size:18px; text-align:center;" required></div>
<div style="display: inline-block; margin-left:25px; "><input type="submit" name="guarda" value="VALIDAR TOKENS ABONADOS"></div>
<div style="display: inline-block; margin-left:25px; "><input type="submit" name="eliminar" value="Eliminar cuenta de usuario" onclick="return pregunta();"></div>
<input type="hidden" value="$row[0]" name="correo">
<div style="border-bottom:1px solid #c0c0c0; min-width:95%; margin-top:5px; margin-bottom:0px;"></div>
</form>



HERE;
}



      
      
      
// Mostrar una caja de texto, donde introducir un código, verificar y activar los tokens abonados.
//$valor = $this->conectar("select * from creditos where id= $ident", "1");
//print <<<HERE
//<div align="center">
//<br /><br /><h1>Verificar cobro de tokens</h1>
//     <form action="" method="post" name="formtok">
//           <input type="text" name="" value="" style="width: 250px; height: 45px; font-size:22px; text-align:center; margin-top:50px; vertical-align:top;" tabindex="1" accesskey="b" placeholder="CÓDIGO" autofocus required>
//           <input type="submit" name="guarda" value="VALIDAR TOKENS ABONADOS" style="width: auto; height: 45px; margin-top:50px; vertical-align:top;">
//     </form>
//</div>
//HERE;

      }
      
      function edicondi()
      {
if(isset($_POST['textcondi'])){
$this->conectar("update textos SET texto = '$_POST[textcondi]' where id = '1'", "0");
print <<<HERE
<h1 style="text-align:center;">Los datos han sido actualizados</h1><br />
HERE;

print <<<HERE
<meta http-equiv="refresh" content="2;URL=index.php?m=3">
HERE;

}else{
$texto = $this->conectar("select * from textos where id= 1", "1");
// Editar las condiciones de uso. Mostrar en una caja de texto grande las "condiciones de uso" y boton para actualizar.
print <<<HERE
<div align="center">
     <form action="" method="post" name="formtok"><h1>Editar Condiciones de uso</h1>
           <textarea name="textcondi" style="width: 90%; min-height:500px;">$texto</textarea><br /><br />
           <input type="submit" name="guarda" value="Guardar cambios">
     </form>
</div>
HERE;
}


      }
      




      function CuentCreditos()
       {
include "bdEX.php";
$link=ConectarEX("s18ea85d_lubricam");
$result = mysql_query("select * from creditos", $link);
$x = 0;
while ($row = mysql_fetch_row($result)){
$x = $x + $row[1];
}
return $x;
mysql_close($link);
}






             function cuenta_filas($tabla)
      {

include "bdEX.php";
$link9o=ConectarEX("s18ea85d_lubricam");
            $result = mysql_query("SELECT * FROM $tabla", $link9o);
                    if (@$row = mysql_fetch_array($result)){
                    $num_total_registros = mysql_num_rows($result);
                    return $num_total_registros;
            } else {
                    echo "0";
                   }
      }

      function mostrar_datos()
      {
include "bdEX.php";
$link=ConectarEX("s18ea85d_lubricam");

$consu_1 = mysql_query("SELECT * FROM registro", $link);
if ($row = mysql_fetch_array($consu_1)){ $dato_1 = mysql_num_rows($consu_1);} else {$dato_1 = "0";}
                   
$consu_2 = mysql_query("SELECT * FROM creditos", $link);
$dato_2 = "0";
while ($row = mysql_fetch_array($consu_2)){ $dato_2 = $row[1] + $dato_2; }

$consu_3 = mysql_query("SELECT * FROM online", $link);
if ($row = mysql_fetch_array($consu_3)){ $dato_3 = mysql_num_rows($consu_3);} else {$dato_3 = "0";}

$consu_4 = mysql_query("SELECT * FROM contaud", $link);
if ($row = mysql_fetch_array($consu_4)){ $dato_4 = mysql_num_rows($consu_4);} else {$dato_4 = "0";}

echo ("<h1>Datos</h1>");
echo ("<p style='color:#c0c0c0; margin-top:-25px;'>*Puede pulsar la tecla F5 o refrescar la pagina para actualizar los datos.</p>");
echo ("<ul>");
echo ("<li><h2>Numero total de usuarios registrados: <b>$dato_1</b></h2></li>");
echo ("<li><h2>Numero total de usuarios retransmiendo ahora: <b>$dato_3</b></h2></li>");
echo ("<li><h2>Numero total de audiencia en estos momentos: <b>$dato_4</b></h2></li>");
echo ("<li><h2>Numero total de Tokens en curso: <b>$dato_2</b></h2></li>");
echo ("</ul>");

      }
      
      
      
      
      function menu()
      {
$enlaces = array(1 => "Confirma Tokens", 2 => "Datos", 3 => "Editar condiciones");
print <<<HERE
      <h1 style="text-align:center;"><b> | </b>
HERE;
foreach($enlaces as $valor => $resultado)
{
print <<<HERE
<a href="index.php?m=$valor">$resultado</a><b> | </b>
HERE;
}
echo ("</h1>");
              switch (@$_GET["m"]) {
              case 0:
                   break;
              case 1:
                   echo $this->veritokens($ident="1");
                   break;
              case 2:
                   echo $this->mostrar_datos();
                   break;
              case 3:
                   echo $this->edicondi();
                   break;
              case 4:
              
                   break;
              case 5:
              
                   break;
              default:
                      break;
              }
      }
      

      
      function ejecuta()
      {
      //echo $this->var1;
      //echo $this->var2;
print <<<HERE
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
<title>PANEL - LubriCam.com</title>

<SCRIPT LANGUAGE="JavaScript">
function pregunta() {
if (confirm("ATENCION! Por favor, confirme para eliminar definitivamente la cuenta de usuario.")){
return true; }
return false;
}
</SCRIPT>

</head><body>
HERE;
      echo $this->menu();
      
      
print <<<HERE
</body></html>
HERE;

      }
      



}

$pagina = new panel("hola","<br />Que tal?","","");
$pagina -> ejecuta();

?>
