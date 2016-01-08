<?php

class inicio{

  private $user;
  private $pass;
  private $db;

  function __construct($user, $pass, $db){
    $this->user = $user;
    $this->pass = $pass;
    $this->db = $db;
  }

  function IniciaSesion(){
    session_start();
    $_SESSION['id_sesion'] = session_name();

    if(isset($_SESSION["tmptxt"]))
      return $_SESSION["tmptxt"];
  }

  function redireccion(){
    ?> <meta http-equiv="refresh" content="0;URL=index.php"> <?php
  }

       function cabecera()
       {
print <<<HERE
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
<title>Inicio - LubriCam.com</title>
<meta name="title" content="LubriCam.com" />
<meta name="Description" content="LubriCam, ver webcam en vivo chat con chicas chicos mujeres hombres parejas amateur transexual Bondage Fetiche online cam en vivo para adultos" />
<meta name="robots" content="all, index, follow" />

<link href="data/inicio.css" rel="stylesheet" type="text/css">
<script src='https://www.google.com/recaptcha/api.js'></script>

<SCRIPT LANGUAGE="JavaScript">
function salir() {
if (confirm("&iquest;Realmente desea salir de la p&aacute;gina?")){
return true; }
return false;
}
</SCRIPT>
</head>
<body>
<div align="center">
<div class="marco">
<div class="IntMar">
<a href="javascript:history.go(-2)" title="Cerrar" alt="Cerrar" onclick="return salir();" rel="nofollow"><p style="float:right; margin: 10px;"><font color="#000">X</font></p></a>

<p class="hini">Bienvenido al video chat <br />m&aacute;s caliente</p>
HERE;
     }
     
  function cuerpo(){
    switch (@$_GET["a"]) {
      case 0: $this->acceder(); break;
      case 1: $this->registro(); break;
      case 2: $this->recupera(); break;
      default: $this->acceder(); break;
    }
  }


  function pie(){
    ?>
            </div>
          </div>
        </div>
      </body>
    </html>
    <?php
  }


  function acceder(){
    if(isset($_POST["acceso"])){

      $usuario = strip_tags($_POST["usuario"]);
      $clave = strip_tags($_POST["clave"]);

      $this->accesar($usuario, $clave);

      die();
    }else{

      ?>
      <p class="textini">Introduzca su Alias y una Contrase&ntilde;a.</p>

      <form method="post">
        <input type="text" name="usuario" class="cajaini" tabindex="1" placeholder="Aqu&iacute; su alias" autofocus required>
        <input type="password" name="clave" class="cajaini" tabindex="2" placeholder="Aqu&iacute; su contrase&ntilde;a" required>
        <input type="submit" name="acceso" value="Entrar" class="inputini">
      </form>
    
      <a href="inicio.php?a=2"><p style="float:right; margin-right:25px;">&iquest;Has olvidado tu contrase&ntilde;a?</p></a>

      <br /><br />
      <p style="float:left; margin-left:25px;">&iquest;Eres nuevo?</p>
      <a href="inicio.php?a=1" style="text-decoration:none;"><div class="boton_registro">Registrarse</div></a>

      <!--<div class="g-recaptcha" data-sitekey="6LdIhQETAAAAAOe9SwVsEUjmbozPk8H9DWFbNWer"></div>-->

      <br /><br />
      <?php
    }
  }
     
  function registro(){
    $this->pro_registro();
    
    if(isset($_POST["usuario"])){ 
      $usutemp = $_POST["usuario"]; 
    }else{ 
      $usutemp = ""; 
    }

    if(isset($_POST["correo"])){ 
      $cortemp = $_POST["correo"]; 
    }else{ 
      $cortemp = ""; 
    }

    ?>

    <p class="textini">Elije un Alias y una Contrase&ntilde;a f&aacute;cil de recordar</p>

    <form method="post">
      <input type="text" name="usuario" value="<?= $usutemp ?>" class="cajaini" tabindex="1" placeholder="Aqu&iacute; su alias" autofocus required>
      <input type="email" name="correo" value="<?= $cortemp ?>" class="cajaini" tabindex="2" placeholder="Aqu&iacute; su email" required>
      <input type="password" name="clave" class="cajaini" tabindex="3" placeholder="Aqu&iacute; su contrase&ntilde;a" autocomplete="off" required>
      <input type="password" name="conclave" class="cajaini" tabindex="4" placeholder="Vuelva a escribir su contrase&ntilde;a" autocomplete="off" required>

      <div class="acepini"> 
        <input type="checkbox" name="acepta" tabindex="5" required> He le&iacute;do y acepto los <a href="faqs.html#Nuestros%20T%C3%A9rminos%20y%20Condiciones%20de%20Uso" target="_blank">t&eacute;rminos y condiciones</a> de este sitio Web, declarando ser mayor de edad.
      </div>
      <img src="data/captcha.php" width="100" height="30" vspace="3" border="1" style="margin-top:3px;">
      <input type="text" name="numero_seg" class="CajaStyleCod" onpaste="return false" tabindex="6" autocomplete="off" required>     
      <input type="submit" name="registro" value="Registrarme" class="inputini">
    </form>
    <br /><br />
    <a href="javascript:history.go(-1)" style="color:#000; font-size:1.4em;">  << Volver atr&aacute;s </a>
    <br /><br /><br />
    <?php
  }
     
     
      function VerFiMa($correo)
      {
       #$link=mysql_connect("localhost", $this->user, $this->pass);
       $link=mysql_connect("localhost", 'root', '');
       mysql_select_db($this->db, $link);

       $result = mysql_query("SELECT * FROM registro WHERE correo = '$correo'", $link);
       @$Nfilas = mysql_num_rows($result);
       if($Nfilas){
       return true;
       }else{
       return false;
       }
       

       mysql_close($link);
      }
     
     
     
  function pro_registro(){
    if(isset($_POST["registro"])){
      $usuario = strip_tags($_POST["usuario"]);
      $clave = strip_tags($_POST["clave"]);
      $correo = strip_tags($_POST["correo"]);
      $numero = $_SESSION["tmptxt"]; //El que se crea
      $num = $_POST["numero_seg"]; //El que escribe

      if($numero == $num){
        if($this->VerFiMa($correo)){ 
          $this->mensaje("7", ""); 
        }else{ // El email ya se encuentra registrado, ¿Recuperar cuenta?
          if($this->veriusu($usuario)){ 
            $this->mensaje("8", ""); 
          }else{ //El usuario existe, elije otro.
            $claveR = $clave;
            //$clave = md5($claveR);
            $clave = $claveR;
            $fecha = date("Y-m-d"); //$fecha = date("y-m-d G:i:s");
            $remoto = $_SERVER['REMOTE_ADDR'];
            #$link = mysql_connect("localhost", $this->user, $this->pass);
            $link=mysql_connect("localhost", 'root', '');
            mysql_select_db($this->db, $link);
            $query = "INSERT INTO registro (usuario, correo, clave, fecha_registro) values ('$usuario','$correo','$clave','$fecha')";
            $result = mysql_query($query,$link);
       
            if ($result){
              //$_SESSION["codtemp"] = $row[0]; //Inicia variable de sesion.
              //header("Location: index.php");
              $this->mensaje("9", "1");
              // Tengo que probarlo. Pero es para crear una entrada nada mas registrarse.
              $querydos = "INSERT INTO ultima_entrada (entrada, remoto, usuario, correo) values ('$fecha','$remoto','$usuario','$correo')";
              //$resultdos = mysql_query($querydos,$link);
              mysql_query($querydos,$link);
              $sacaid = mysql_query("SELECT id FROM registro WHERE correo = '$correo'", $link);
              if (@$row = mysql_fetch_array($sacaid)){ 
                $id = $row[0]; 
              }else{ 
                $id = false; 
              }

              $querytres = "INSERT INTO perfil(id,correo,edad,alias,idioma,pais,localidad,detalles,descripcion) values('$id','$correo','','$usuario','','','','','')";
              mysql_query($querytres,$link);

              ?>
                <meta http-equiv="refresh" content="3;URL=index.php">
              <?php
            }else{
              echo "ERROR";
            }//No se ha podido realizar el registro...

            mysql_close($link);
          }
        }
      }else{ 
        $this->mensaje("2", ""); 
      } //El numero no coincide
    }
  }
     
     function recupera()
     {
if(isset($_POST["recupera"])){ $this->RecuCuenta(); }else{}
print <<<HERE
<p class="textini" style="text-align:left; margin-left:5px; margin-right:5px;"><b>&iquest;Ha perdido su contrase&ntilde;a?</b><br /><br />
Para recuperar los datos de su cuenta, deber&aacute; introducir la direcci&oacute;n de correo electr&oacute;nico que utilizo
para registrarse en esta Web y le enviaremos un e-mail con sus nuevos datos de acceso.</p>

<form method="post">
       <input type="email" name="correo" class="cajaini"  tabindex="1" placeholder="Aqu&iacute; su email" required>
       <br /><br />
       <img src="data/captcha.php" width="100" height="30" vspace="3" border="1" style="margin-top:3px;">
       <input type="text" name="numero_seg" class="CajaStyleCod" onpaste="return false" tabindex="2" autocomplete="off" required>

       <input type="submit" name="recupera" value="Recuperar cuenta" tabindex="3" class="inputini">
</form>
<br /><br />
<a href="javascript:history.go(-1)" style="color:#000; font-size:1.4em;">  << Volver atr&aacute;s </a>
<br /><br /><br />
HERE;
     }
     
      function VeriMail($correo)
      {
       #$link=mysql_connect("localhost", $this->user, $this->pass);
        $link=mysql_connect("localhost", 'root', '');
       mysql_select_db($this->db, $link);
       $query = "SELECT correo FROM registro WHERE correo = '$correo'";
       $result = mysql_query($query, $link);
       @$Nfilas = mysql_num_rows($result);
       return $Nfilas;
       mysql_close($link);
      }
      
      function veriusu($usuario)
      {
       #$link=mysql_connect("localhost", $this->user, $this->pass);
        $link=mysql_connect("localhost", 'root', '');
       mysql_select_db($this->db, $link);
       $query = "SELECT usuario FROM registro WHERE usuario = '$usuario'";
       $result = mysql_query($query, $link);
       @$Nfilas = mysql_num_rows($result);
       return $Nfilas;
       mysql_close($link);
      }
      
  function veriusuacceso($usuario){
    #$link=mysql_connect("localhost", $this->user, $this->pass);
    $link=mysql_connect("localhost", 'root', '');
    mysql_select_db($this->db, $link);
    $query = "SELECT usuario FROM registro WHERE usuario = '$usuario' OR correo = '$usuario'";
    $result = mysql_query($query, $link);
    @$Nfilas = mysql_num_rows($result);
    mysql_close($link);
    return $Nfilas;
  }

  function accesar($usuario, $clave){
    if($this->veriusuacceso($usuario)){
       #$link = mysql_connect("localhost", $this->user, $this->pass);
       $link = mysql_connect("localhost", 'root', '');
       mysql_select_db($this->db, $link);
       //$email = $_POST["email"];
       $claveR = $clave;
       //$clave = md5($claveR);
       $clave = $claveR;

       $query = "SELECT * FROM registro WHERE (usuario = '$usuario' AND clave = '$clave') OR (correo = '$usuario' AND clave = '$clave')";
       $result = mysql_query($query,$link);

       @$Nfilas = mysql_num_rows($result);

       if ($Nfilas != 0){
         //Si el Nfilas fuera mayor de uso, tambien seria un problema, que en teoria no se deberia dar.
         //he cambiado el WHILE por el IF
         if ($row = mysql_fetch_row($result)){

          $fecha = date("Y-m-d"); //$fecha = date("y-m-d G:i:s");
          $remoto = $_SERVER['REMOTE_ADDR'];
          //$consulta = mysql_query("SELECT usuario, email FROM ultimas_entradas WHERE (usuario = '$row[1]' AND email = '$row[2]')");

           ///   !!!!!! !!!!!! !!!!!!
          // ATENTO!!! He desabilitado esto, por que al acceder, guardaba el registro en "Ultimo_acceso" y luego en "monedero" no reconocia el ultimo acceso real, ya que este lo cambiava al acceder... Revisar mas atentamente
          //mysql_query("DELETE FROM ultima_entrada WHERE (usuario = '$row[1]' AND correo = '$row[2]')");
          //mysql_query("INSERT INTO ultima_entrada (entrada, remoto, usuario, correo) values ('$fecha','$remoto','$row[1]','$row[2]')");

          $unitemp = $this->PassAlea();
          $unico = md5($unitemp);
         
          $_SESSION["codtemp"] = $unico;
          $_SESSION["numus"] = $row[0];


          mysql_query("INSERT INTO logeo (correo, unico, remoto, fecha) VALUES ('$row[2]','$unico','$remoto','$fecha')",$link);

          //header("Location: http://galeriavirginia.proyecto37.com/pag4/index.php");
          //header("Location: index.php");
          
          if(isset($_POST["acceso"]) && isset($_POST['login'])){
            echo "OK"; 
          }else{
          ?>
            <meta http-equiv="refresh" content="0;URL=index.php">
          <?php 
          }
        }
      }else{ 
        if(isset($_POST["acceso"]) && isset($_POST['login'])){
          echo "FAIL"; 
        }else{
          $this->mensaje("3", ""); 
        }
      }
        
      mysql_close($link);
    }else{  
      if(isset($_POST["acceso"]) && isset($_POST['login'])){
        echo "FAIL2"; 
      }else{
        $this->mensaje("4", ""); 
      }
    }
  }



      function RecuCuenta()
      {
$numero = $_SESSION["tmptxt"]; //El que se crea
$num = $_POST["numero_seg"]; //El que escribe
if($numero == $num){
$email = $_POST["correo"];
if(@$this->VeriMail($email) != 0){
#$link = mysql_connect ("localhost", $this->user, $this->pass);
$link=mysql_connect("localhost", 'root', '');
mysql_select_db($this->db, $link);
$result = mysql_query("SELECT * FROM registro WHERE correo = '$email'", $link);
if ($row = mysql_fetch_row($result)){
//$clave = $this->PassAlea();
//$encpas = md5($clave);
$clave = $row[3];
$encpas = $clave;
mysql_query("UPDATE registro SET clave = '$encpas' WHERE id = '$row[0]'",$link);

$dia=date("d-m-Y");
$hora=date("H:i:s");
$destinatario = $email;
$subject = "Recuperar datos de su cuenta de lubricam.com";
$desde = 'From: http://www.lubricam.com';
$contenido = "El mensaje se a enviado el d&iacute;a $dia a las $hora
\n
Este mensaje se a enviado desde www.lubricam.com Por favor si usted no a solicitado este servicio, rogamos nos lo comunique (info@lubricam.com). Gracias.

Como nos ha solicitado atraves de nuestro sistema de recuperaci&oacute;n de claves, aqui le enviamos su contrase&ntilde;a.
clave: $clave
\n\n";
$mail = @mail($destinatario, $subject, $contenido, $desde);
if($mail){ $this->mensaje("5", "1"); }else{ $this->mensaje("6", ""); }

}
}else{ $this->mensaje("1", ""); }
}else{ $this->mensaje("2", ""); }
      }



  function PassAlea(){
    $NumAlea = rand(0,999);
    $NA = rand(0,99);
    $Sila = array(
          0 => "A", 1 => "B", 2 => "C", 3 => "D", 4 => "E", 5 => "F", 6 => "G", 7 => "H", 8 => "I", 9 => "J",
          10 => "K", 11 => "A3", 12 => "m2", 13 => "M", 14 => "N", 15 => "W", 16 => "P", 17 => "E", 18 => "U",
          19 => "V", 20 => "W", 21 => "X", 22 => "Y", 23 => "Z");

    $SAleN = rand(0, 23);

    $Sila2 = array(
          0 => "a", 1 => "b", 2 => "c", 3 => "d", 4 => "e", 5 => "f", 6 => "g", 7 => "h", 8 => "I", 9 => "j",
          10 => "K", 11 => "U2", 12 => "G7", 13 => "m", 14 => "n", 15 => "T", 16 => "p", 17 => "q", 18 => "u",
          19 => "v", 20 => "w", 21 => "x", 22 => "y", 23 => "z");

    $SAleN2 = rand(0, 23);

    $Sila3 = array(
          0 => "a", 1 => "b", 2 => "c", 3 => "d", 4 => "e", 5 => "f", 6 => "g", 7 => "h", 8 => "i", 9 => "j",
          10 => "k", 11 => "K", 12 => "R", 13 => "m", 14 => "n", 15 => "Y", 16 => "p", 17 => "D", 18 => "u",
          19 => "v", 20 => "w", 21 => "x", 22 => "y", 23 => "z");

    $SAleN3 = rand(0, 23);

    $pass = $Sila[$SAleN].$NumAlea.$Sila2[$SAleN2].$Sila3[$SAleN3].$NA;

    return $pass;
  }

  function mensaje($dato, $maca){
    if($maca == 1)
      $usa="success";
    else
      $usa="error";

    echo ("<div class='$usa' style='margin-bottom:-50px; margin-top:35px;'>");

    switch (@$dato) {
      case 0: echo("ERROR"); break;
      case 1: echo("El email introducido no se encuentra registrado."); break;
      case 2: echo("El numero de seguridad no coincide."); break;
      case 3: echo("Lo sentimos... Los datos de acceso introducidos no son correctos."); break;
      case 4: echo("El usuario introducido no se encuentra registrado."); break;
      case 5: echo("Le llegara un email con su nueva contrase&ntilde;a."); break;
      case 6: echo("Ups! Lo sentimos, el proceso no ha podido realizarse.<br /> Por favor intentolo de nuevo m&aacute;s tarde."); break;
      //Registro de usuario.
      case 7: echo ("El email ya se encuentra registrado, <a href='inicio.php?a=2'>&iquest;Recuperar cuenta?</a>"); break;
      case 8: echo ("El usuario existe, elije otro."); break;
      case 9: echo ("Enhorabuena!!! Se ha registrado correctamente."); break;
      case 10: echo (""); break;
      
      default: echo("ERROR"); break;
    }

    echo ("</div>");
  }
       
  function mostrar(){
    if(isset($_POST["acceso"]) && isset($_POST['login'])){
      $this->IniciaSesion();
      $this->cuerpo();
    }else{
      $this->IniciaSesion();
      $this->cabecera();
      $this->cuerpo();
      $this->pie();
    }

  }
}

$pagina = new inicio("s18ea85d_fran","df6s8ref34","s18ea85d_lubricam");
$pagina->mostrar();

?>
