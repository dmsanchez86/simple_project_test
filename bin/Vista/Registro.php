<?php require_once '../Controler/Registro.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <title>Inicio - LubriCam.com</title>
    <meta name="Description" content="LubriCam, ver webcam en vivo chat con chicas chicos mujeres hombres parejas amateur transexual Bondage Fetiche online cam en vivo para adultos" />
    <meta name="robots" content="all, index, follow" />
    <link href="../assets/css/inicio.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/basico.css" rel="stylesheet" type="text/css">
    <script src="../assets/js/jquery-2.1.4.js" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="../assets/js/registro.js" type="text/javascript"></script>
    <script src="../assets/js/basico.js" type="text/javascript"></script>
</head>
<body>
<div align="center">
<div class="marco">
<div class="IntMar">
<a href="javascript:history.go(-2)" title="Cerrar" onclick="return salir();" rel="nofollow"><p style="float:right; margin: 10px;"><font color="#000">X</font></p></a>

<p class="hini">Bienvenido al video chat <br />m&aacute;s caliente</p><p class="textini">Elije un Alias y una Contrase&ntilde;a f&aacute;cil de recordar</p>
<div id="login-registro">
    <div id="login">
        <form method="post" action="Registro.php">
               <input type="text" name="usuariologin" class="cajaini" tabindex="1" placeholder="Aqu&iacute; su alias" autofocus required>
               <input type="password" name="clavelogin" class="cajaini" tabindex="2" placeholder="Aqu&iacute; su contrase&ntilde;a" required>
               <?php echo $mensaje; ?>
               <input type="submit" name="acceso" value="Entrar" class="inputini">
        </form>
        <a href="inicio.php?a=2"><p style="float:right; margin-right:25px;">&iquest;Has olvidado tu contrase&ntilde;a?</p></a>
        <br /><br />
        <p style="float:left; margin-left:25px;">&iquest;Eres nuevo?</p>
        <a href="#" style="text-decoration:none;"><div id="registrarse" class="boton_registro">Registrarse</div></a>
    </div>
    <div id="registro" class="oculto">
        <form method="post" action="Registro.php">
               <input id="nick" type="text" name="usuario" value="" class="cajaini" tabindex="1" placeholder="Aqu&iacute; su alias" autofocus required>
               <div id="errorNick"></div>
               <input id="correo" type="email" name="correo" value="" class="cajaini" tabindex="2" placeholder="Aqu&iacute; su email" required>
               <div id="errorCorreo"></div>
               <input type="password" name="clave" class="cajaini" tabindex="3" placeholder="Aqu&iacute; su contrase&ntilde;a" autocomplete="off" required>
               <input type="password" name="clave2" class="cajaini" tabindex="4" placeholder="Vuelva a escribir su contrase&ntilde;a" autocomplete="off" required>
               <div class="acepini"> <input type="checkbox" name="acepta" tabindex="5" required> He le&iacute;do y acepto los <a href="faqs.html#Nuestros%20T%C3%A9rminos%20y%20Condiciones%20de%20Uso" target="_blank">t&eacute;rminos y condiciones</a> de este sitio Web, declarando ser mayor de edad.</div>
               <img src="../data/captcha.php" width="100" height="30" vspace="3" style="margin-top:3px;">
               <input type="text" name="numero_seg" class="CajaStyleCod" tabindex="6" autocomplete="off" required>
               <input type="submit" name="registro" value="Registrarme" class="inputini">
        </form>

        <br/><br/>
        <a id="volver" style="color:#000; font-size:1.4em;">  << Volver atr&aacute;s </a>
    </div>
</div>
<br /><br /><br /></div></div></div>
</body>
</html>