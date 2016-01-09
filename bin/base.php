<?php

class webchat{

  private $user;
  private $pass;
  private $db;

  public $path_route;

  function __construct($user, $pass, $db){
     $this->user = $user;
     $this->pass = $pass;
     $this->db = $db;

     $this->path_route = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  }

  function scripts(){
    //<link href="data/grid.css" rel="stylesheet">
    //<link rel="stylesheet" type="text/css" href="chat/js/jScrollPane/jScrollPane.css" />
    ?>

    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox-1.3.4.css" />
    <link rel="stylesheet" href="data/menu.css" type="text/css" media="screen" />
    <link href="data/bootstrap.css" rel="stylesheet">
    <link href="data/style.css" rel="stylesheet" type="text/css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="favicon.png">

    <!--[if lt IE 9]>
      <script src="data/html5shiv.js"></script>
      <script src="data/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <?php
      if(isset($_SESSION["codtemp"])){
        $etem = $this->sacacorre();

        if(isset($_GET["m"]) && ($_GET["m"] == 99)){

        //Encriptar $etem (correo) y desencriptar en ".php"
        ?>
          <script type="text/javascript">
              function getTimeAJAX() {
                  var time = $.ajax({
                      url: "time.php?e=<?= $etem ?>",
                          dataType: 'text',
                          async: false
                  }).responseText;

                  console.log(time);

                  document.getElementById("myWatch").innerHTML = time;
                  if(time == "0"){
                  document.location.href='index.php';
                  }else{}
              }
              setInterval(getTimeAJAX,3000);

              function getTokeAJAX() {
                  var toke = $.ajax({
                      url: "toke.php?e=<?= $etem ?>",
                          dataType: 'text',
                          async: false
                  }).responseText;
                  document.getElementById("myToken").innerHTML = +toke;
              }
              setInterval(getTokeAJAX,60000);
          </script>
        <?php

        }else{
          // Muestra Fichas
          ?>
          <script type="text/javascript">
              function getTimeAJAX() {
                  var time = $.ajax({
                      url: "time.php?e=<?= $etem ?>",
                          dataType: 'text',
                          async: false
                  }).responseText;
                  document.getElementById("myWatch").innerHTML = +time;
              }
              setInterval(getTimeAJAX,3000);

              // Muestro el popup de bienvenida siempre que se inicia sesion
              setTimeout(function(){
                if(localStorage.getItem('first_popup') != "true")
                  if(localStorage.getItem('log') == 'true')
                    $('#log_in').addClass('open_popup');
              }, 1000);

              // ejecuto popup temporizador 2 cuando ya esta logueado
              setInterval(function(){ 
                if(localStorage.getItem('log') == 'true'){
                  setTimeout(function(){
                    $('#temp2').addClass('open_popup'); 
                  },300);
                }
              }, 300000);
          </script>
          <?php
        }
      }else{ // Si no ha iniciado sesion ejecuto el popup del temporizador 1 cada 60 segundos ?>
        <script>
          localStorage.removeItem('first_popup');

          setInterval(function(){ 
            if(localStorage.getItem('validate') == 'true'){
              $('#login').removeClass('open_popup'); 
              $('#register').removeClass('open_popup'); 
              $('#forget_password').removeClass('open_popup'); 
              setTimeout(function(){
                $('#temp1').addClass('open_popup'); 
              },300);
            }
          }, 300000);
        </script>
      <?php 
      }

      $urlAl = "20000;URL=";

      if(isset($_GET["m"])){
        if($_GET["m"] == "55"){}
        elseif($_GET["m"] == "44"){}
        elseif($_GET["m"] == "33"){}
        elseif($_GET["m"] == "77"){}
        elseif($_GET["m"] == "99"){}
        elseif($_GET["m"] == "22"){}
        elseif($_GET["m"] == "10"){}
        else{
          ?><meta http-equiv="refresh" content="<?= $urlAl ?>"><?php
        }
      }else{
          ?><meta http-equiv="refresh" content="<?= $urlAl ?>"><?php
      }
  }

  function IniciaSesion(){
    ini_set("session.cookie_lifetime","7200");
    ini_set("session.gc_maxlifetime","7200");
    session_start();
    $_SESSION['id_sesion'] = session_name();
    if(isset($_SESSION["tmptxt"]))
      return @$_SESSION["tmptxt"];
  }

    //�Guardar aqui ultimo acceso.. tambien?
  function cerrarSesion(){
    #$link = mysql_connect("localhost", $this->user, $this->pass);
    $link = mysql_connect("localhost", 'root', '');
    mysql_select_db($this->db, $link);

    $x1 = $_SESSION["codtemp"];
    $x2 = $this->sacacorre();
       
    $resultdos = mysql_query("SELECT * FROM registro WHERE correo = '$x2'", $link);

    if (@$row = mysql_fetch_row($resultdos)){
      mysql_query("DELETE FROM online WHERE id_usu = '$row[0]'",$link);
      @unlink("chat/$row[1].html");
    }else{}
       
    $query = "DELETE FROM logeo WHERE correo = '$x2'";
    $result = mysql_query($query,$link);

    if($result){
      session_destroy();
      session_unset();
      unset ($_SESSION["codtemp"]);
      unset ($_SESSION["numus"]);
      // Redirecciono si la sesion ce cierra correctamente
      ?>
      <script> window.location = "./index.php";</script>
      <?php
    }else{ echo ("<h1>ERROR!!</h1>"); }

    mysql_close($link);
  }

  function meta_tags(){

    if(isset($_GET["m"])){
      if($_GET["m"] == 1){
        ?>
        <title>Populares - LubriCam.com</title>
        <meta name="title" content="Populares" />
        <meta name="Description" content="LubriCam, selecciona webcam en vivo chat con chicas chicos mujeres hombres parejas amateur transexual Bondage Fetiche online cam en vivo para adultos." />
        <?php
      }elseif($_GET["m"] == 2){
        ?>
        <title>Mujeres - LubriCam.com</title>
        <meta name="title" content="Mujeres" />
        <meta name="Description" content="LubriCam, ver webcam en vivo chat con chicas  mujeres  amateur  Bondage Fetiche online cam en vivo para adultos." />
        <?php
      }elseif($_GET["m"] == 3){
        ?>
        <title>Hombres - LubriCam.com</title>
        <meta name="title" content="Hombres" />
        <meta name="Description" content="LubriCam, ver webcam en vivo chat con chicos  hombres  amateur  Bondage Fetiche online cam en vivo para adultos." />
        <?php
      }elseif($_GET["m"] == 4){
        ?>
        <title>Parejas - LubriCam.com</title>
        <meta name="title" content="Parejas" />
        <meta name="Description" content="LubriCam, ver webcam en vivo chat con parejas jovenes  amateur  Bondage Fetiche online cam en vivo para adultos." />
        <?php
      }elseif($_GET["m"] == 5){
        ?>
        <title>Transexuales - LubriCam.com</title>
        <meta name="title" content="Transexuales" />
        <meta name="Description" content="LubriCam, ver webcam en vivo chat con trans  transexual  amateur  Bondage Fetiche online cam en vivo para adultos." />
        <?php
      }elseif($_GET["m"] == 6){
        ?>
        <title>Bondage - LubriCam.com</title>
        <meta name="title" content="Bondage" />
        <meta name="Description" content="LubriCam, ver webcam en vivo chat estilo bondage fetiche maquinas masturbacion con chicas  mujeres chicos mujeres hombres parejas amateur transexual online cam en vivo para adultos." />
        <?php
      }elseif($_GET["m"] == 7){
        ?>
        <title>Grupo - LubriCam.com</title>
        <meta name="title" content="Grupo" />
        <meta name="Description" content="LubriCam, ver webcam en vivo chat en grupo orgia chicas  mujeres chicos mujeres hombres parejas amateur transexual Bondage Fetiche online cam en vivo para adultos." />
        <?php
      }elseif($_GET["m"] == 44){
        ?>
        <title>Transm&iacute;tete a ti mismo - LubriCam.com</title>
        <meta name="title" content="Transm&iacute;tete a ti mismo" />
        <meta name="Description" content="LubriCam, emite desde tu web cam en vivo chat con chicas chicos mujeres hombres parejas amateur transexual Bondage Fetiche online  cam en vivo para adultos." />
        <?php
      }elseif($_GET["m"] == 55){
        ?>
        <title>Buscador - LubriCam.com</title>
        <meta name="title" content="Buscador" />
        <meta name="Description" content="Buscador de LubriCam, ver webcam en vivo chat en grupo orgia chicas  mujeres chicos mujeres hombres parejas amateur transexual Bondage Fetiche online cam en vivo para adultos." />
        <?php
      }else{ //Si existe la variable pero no coincide. Datos por defecto.
        ?>
        <title>LubriCam.com</title>
        <meta name="title" content="LubriCam.com" />
        <meta name="Description" content="LubriCam, ver webcam en vivo chat con chicas chicos mujeres hombres parejas amateur transexual Bondage Fetiche online cam en vivo para adultos" />
        <?php
      }
    }else{
      //Titulo index
      ?>
      <title>LubriCam.com</title>
      <meta name="title" content="LubriCam.com" />
      <meta name="Description" content="LubriCam, ver webcam en vivo chat con chicas chicos mujeres hombres parejas amateur transexual Bondage Fetiche online cam en vivo para adultos" />
      <?php
    }
    ?>
      <meta name="robots" content="all, index, follow" />
    <?php
  }

  function cambiarFormatoFecha($fecha){
    list($anio,$mes,$dia) = explode("-", $fecha);
    return $dia."-".$mes."-".$anio;
  }

  function mostrar_enlaces(){
    if(isset($_GET["l"])){ $enlo = $_GET["l"]; }else{ $enlo = ""; }

    switch (@$_GET["m"]) {
      case 1: echo $this->demoos(); break;
      case 2: echo $this->demoos(); break;
      case 3: echo $this->demoos(); break;
      case 4: echo $this->demoos(); break;
      case 5: echo $this->demoos(); break;
      case 6: echo $this->demoos(); break;
      case 7: echo $this->demoos(); break;
      case 8: break;
      case 9: $this->logienla($enlo); break;
      case 10: $this->procoto(); break;
      case 22: $this->cobratok(); break; //Recarga Tokens
      case 33: $this->recarga(); break;
      case 44: $this->retransmite(); break;
      case 55: $this->buscador(); break;
      case 66: $this->confusu(); break;
      case 77: $this->formtrans(); break;
      case 88: $this->cerrarSesion(); break;
      case 99: $this->auditor($id = $_GET["id"]); break;
      default: echo $this->demoos(); break;
    }
  }

  function sacacorre(){
    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link=mysql_connect("localhost", 'root', '');
    mysql_select_db($this->db, $link);
    $idusu = @$_SESSION["numus"];
    $result = mysql_query("SELECT * FROM registro WHERE id = '$idusu'", $link);
    if (@$row = mysql_fetch_array($result)){
      return $row[2];
    } else { return false; }
    mysql_close($link);
  }

  function sacaidusu(){
    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link=mysql_connect("localhost", 'root', '');
    mysql_select_db($this->db, $link);
    $idusu = $_SESSION["numus"];
    $result = mysql_query("SELECT * FROM registro WHERE id = '$idusu'", $link);
    if (@$row = mysql_fetch_array($result)){
      return $row[0];
    } else { return false; }
    mysql_close($link);
  }

  function monedero(){
    //Antes de nada, comprueba si $_SESSION["costemp"] existe y coincide.
    if(isset($_SESSION["codtemp"])){
      $codtemp = $_SESSION["codtemp"];
      $correo = $this->sacacorre();
      $ultimoacc = $this->sacadato("entrada", "ultima_entrada");
      $hoy = date("Y-m-d");

      $vercodtemp = $this->consulta("SELECT * FROM logeo WHERE unico = '$codtemp' AND correo = '$correo'");
      if($vercodtemp){ // Correcto, esta logeado
        $creditos = $this->sacadato("fichas", "creditos");
        if($creditos == false){
          $this->consulta("INSERT INTO creditos (correo, fichas) VALUES ('$correo','5')"); // Inicia fichas
        }elseif($creditos < 5){  //Si tiene menos de 5 fichas
          if($ultimoacc < $hoy){  // Comprueba si han pasado 24h. SI (+5fichas) NO (nada)
            if($this->consulta("SELECT * FROM creditos WHERE correo = '$correo'")){  // Existe, tiene algo de credito, menos de 5 fichas.
              $this->consulta("UPDATE creditos SET fichas = 5 WHERE correo = '$correo'"); // Reset fichas
            }else{
              $this->consulta("INSERT INTO creditos (correo, fichas) VALUES ('$correo','5')"); // Inicia fichas
            }
          }   //exit;  No han pasado 24h, no hacemos nada.
        }
        $this->consulta("UPDATE ultima_entrada SET entrada = '$hoy' WHERE correo = '$correo'");
      }
    }
  }

  //////// ESTA NO SE ESTA USANDO
  function confusu(){
    ?>
    <div align="center">
      <div class="marfor1">
        <div align="left">
          <h1 style="margin: 5px; color:#c61863; font-size:1.9em;">Editar configuraci&oacute;n</h1>
          <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
          <div class="form-group">
            <p class="texthead">Correo electr&oacute;nico de seguridad:</p>
            <p>Si olvida su Alias o Contrase&ntilde;a le enviaremos un correo de recuperaci&oacute;n a:</p>
            <input type="text" class="form-control" id="recupera" name="recupera" placeholder="Introduce tu correo electr&oacute;nico">
          </div>
          <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
          <p class="texthead">Monedero:</p>
          Recarga Tokens <a href="" class="texthead">aqu&iacute;</a><br />
          Descargar Tokens <a href="" class="texthead">aqu&iacute;</a><br />
          Asociar <a href="" class="texthead">Tarjeta</a> o <a href="" class="texthead">N&uacute;mero Bancario</a><br />
          <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
          <p class="texthead">Favoritos:</p>
          Configura la lista de tus camaras favoritas <a href="" class="texthead">aqu&iacute;</a><br />
          <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
          <p class="texthead">Mi Cuenta</p>
          <p><b>Cambio de Alias</b></p>
          <div class="form-group">
            <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias actual">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="newalias" name="newalias" placeholder="Nuevo Alias">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="verinewalias" name="verinewalias" placeholder="Repita su nuevo alias">
          </div>
          <input type="submit" name="enviar" value="Actualizar" class="btn btn-primary btn-lg">
          <br /><br /><br />
          <p><b>Cambio de Contrase&ntilde;a</b></p>
          <div class="form-group">
            <input type="text" class="form-control" id="pass" name="pass" placeholder="Contrase&ntilde;a actual">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="newpass" name="newpass" placeholder="Nueva contrase&ntilde;a">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="newpassveri" name="newpassveri" placeholder="Repita su nueva contrase&ntilde;a">
          </div>
          <input type="submit" name="enviar" value="Actualizar" class="btn btn-primary btn-lg">
          <br /><br />
          <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
          Eliminar cuenta de usuario <a href="" class="texthead">aqu&iacute;</a>
        </div>
      </div>
    </div>   
    <?php
  }

  function enlaces(){
		   
    $menu = array (
      44 => "Retransmitirte a ti mismo",
      1 => "POPULAR",
      2 => "MUJERES",
      3 => "HOMBRES",
      4 => "PAREJAS",
      5 => "TRANSEXUAL",
      6 => "BONDAGE",
      7 => "GRUPO"
    );
       
    ?>

    <div style="">
      <div class="navbar navbar-inverse navbar-static-top">
        <ul class="nav navbar-nav" style="display: inline-block;">
          <?php
            foreach ($menu as $indice => $valor) {

              if(@$_GET["m"] == $indice)
                $activar = " active "; 
              else
                $activar = ""; 
            
              if($indice==1){
                $p="#FB9729";
                $e="";
              }elseif($indice==2){
                $p="#FF2F2F";
                $e="";
              }elseif($indice==3){
                $p="#0070C0";
                $e="";
              }elseif($indice==4){
                $p="#7030A0";
                $e="";
              }elseif($indice==5){
                $p="#00B050";
                $e="";
              }elseif($indice==6){
                $p="#FF79AF";
                $e="";
              }elseif($indice==7){
                $p="#948A54";
                $e="";
              }else{
                $p="#00B0F0";
                $e="#retrans";
              }
        	
              if($e!=""){ ?>
            		<li style="display: inline-block;">
                  <a href="#retrans" class="dropdown-toggle <?= $activar ?>" id="retras"  onclick="<?= $e ?>" style="border-top-style: solid;display: inline-block;color:#00B0F0;border-top-color: transparent;"><?= $valor ?></a>
                </li>	
              <?php }else{ ?>
                <li style="display: inline-block;">
                  <a href="index.php?m=<?= $indice ?>" class="<?= $activar ?>" style="display: inline-block;border-top-style: solid;border-top-color: <?= $p ?>;color: <?= $p ?>;font-weight:bold;"><?= $valor ?></a>
                </li>
              <?php }     
            }
          ?>
          <li class="dropdown" style="display: inline-block;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="display: inline-block;color:#00B0F0;">
              Refinar b&uacute;squeda<b class="caret"></b>
            </a>
            <ul class="dropdown-menu" style="overflow: hidden; height: auto">
              <li>
              <?php
                $this->busca();
              ?>
              </li>
            </ul>
          </li>
				  <li>
            <a href="#pie" class="dropdown-toggle"  style="display: inline-block;color:#00B0F0;">Mapa</a>
          </li>
        </ul>
      </div>
    </div>
    <?php
  }

  function recarga(){ ?>
    <div align="center">
      <div class="marfor1">
        <div align="left">
          <h1 style="margin: 5px; color:#c61863; font-size:1.9em;">Compra Tokens</h1>
          <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
          <div class="form-group">
            <p class="texthead">Seleccione - Cantidad de Tokens</p>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="6.99">
                50 Tokens for $6.99
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="10.99">
                100 Tokens for $10.99
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="10.99">
                200 Tokens for $20.99
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="45.99">
                500 Tokens for $45.99
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="65.99">
                750 Tokens for $65.99
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="84.99">
                1000 Tokens for $84.99
              </label>
            </div>
            <p class="texthead">Seleccione - Forma de pago</p>

            <div class="checkbox">
              <label>
                <input type="checkbox" value="6.99">
                <b>CreditCard(Visa/Mastercard/Discover)</b> - Opci&oacute;n r&aacute;pida.
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="10.99">
                <b>Pago con: PayPal/IDeal/DIRECTebanking/UKash/PaySafeCard.</b> - Opci&oacute;n: Confirmaci&oacute;n de pago en menos de 24 horas.
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="10.99">
                <b>Wire Transfer.</b> - Opci&oacute;n: Configuraci&oacute;n de pago de 2 a 4 d&iacute;as h&aacute;biles. S&oacute;lo para cantidades superiores a 2000 Tokens. El valor de la ficha se establece en $0.08 por token. (For example, a wire transfer of $1,000.00will be credited 12,500 tokens). Please contact <a href="mailto:billing@lubricam.com?subject=Facturaci�n">billing@lubricam.com</a> for wire transfer instructions.
              </label>
            </div>
            <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
            <input type="submit" name="enviar" value="Continuar" class="btn btn-primary btn-lg">
            <br /><br /><br />
          </div>
        </div>
      </div>
    </div>
    <?php
  }

  function procoto(){
    //$remoto = $_SERVER['REMOTE_ADDR'];
    $etem = $this->sacacorre();
    $email = $etem;
    $metodo = strip_tags($_POST["metodo"]);
    $datos = strip_tags($_POST["datos"]);

    $dia = date("d-m-Y");
    $hora = date("H:i:s");

    $destinatario = "billing@lubricam.com"; //"info@lubricam.com";
    $subject = "cobrar tokens";
    $desde = "From: lubricam.com";

    $contenido = "
    =====================================================================\n
    El mensaje se a enviado el dia $dia a las $hora\n
    =====================================================================\n
    Email: $email\n
    Metodo de pago: $metodo\n
    Datos bancarios: $datos
    \n\n
    =====================================================================
    - Mensaje enviado desde http://www.lubricam.com -
    =====================================================================
    ";

    $mail = @mail($destinatario, $subject, $contenido, $desde);

    if($mail) {
    ?>
      <div align="center">
        <div class="marfor1">
          <div align="left">

            <h1 style="margin: 5px; color:#c61863; font-size:1.9em;">Solicitud enviada con exito.</h1>
            <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
            <p class="texthead">Tramitaremos su solicitud lo antes posible. Gracias.</p>
          </div>
        </div>
      </div>
    <?php
    }else{
    ?>
      <div class="error"> Lamentablemente su solicitud no ha podido enviarse, por favor intentelo de nuevo m�s tarde.<br /><br /> Disculpe las molestias.</div>
    <?php
    }
  }
                          
  function cobratok(){
    ?>
    <div align="center">
      <div class="marfor1">
        <div align="left">
          <h1 style="margin: 5px; color:#c61863; font-size:1.9em;">Cobrar Tokens</h1>
          <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
          <form method="post" action="index.php?m=10" name="formcobto">
            <div class="form-group">  
              <p class="texthead">Metodo de pago:</p>
              <select name="metodo" tabindex="1" class="form-control" required>
                <option value=""></option>
                <option value="Pay-Pal">Pay-Pal</option>
                <option value="visa">Visa</option>
              </select>
            </div>
            <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
            <p class="texthead" style="margin-bottom:-19px;">Datos bancarios:</p><br />
            <textarea name="datos" class="form-control" style="width:100%; height:175px;" placeholder="" required></textarea>
            <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
            <input type="submit" name="enviar" value="Solicitar" class="btn btn-primary btn-lg">
            <br /><br /><br />
          </form>
        </div>
      </div>
    </div>
    <?php
  }
              
  function pregunta(){
    $filename = md5($_SERVER['REMOTE_ADDR']).'.jpg';
    $link = mysql_connect("localhost","root","");
    mysql_select_db("s18ea85d_lubricam", $link);
    $correo = $this->sacacorre();
    mysql_query("UPDATE online SET foto = '$filename' WHERE correo = '$correo'", $link);
  }
              
  function retransmite(){
    //<iframe src="http://www.ustream.tv/embed/20257327?wmode=direct" style="border: 0 none transparent;"  webkitallowfullscreen allowfullscreen frameborder="no" width="480" height="302"></iframe>

    $id_usu = @$_SESSION["numus"];
    $id = $id_usu;
    $name = @$_SESSION['name'];
    $correo = $this->sacacorre();
    $usu = $this->sacadato("1", "registro");

    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link = mysql_connect("localhost",'root','');

    mysql_select_db($this->db, $link);
              
    if(isset($_POST["enviar"])){
      $nombre_usu = ucfirst($usu);
      $fotoname = 'uploads/original/'.md5($_SERVER['REMOTE_ADDR']).'.jpg';
      $foto = $fotoname;
      $nombre = $usu;
      $fecha = @$_POST["fecha"];
      $sexo = $_POST["sexo"];
      $edad = $_POST["edad"];
      $emision = $_POST["emision"];
      $bondage = $_POST["bondage"];
      $zona = $_POST["zona"];
      $codigo = $_POST["codigo"];
      $audiencia = "0";
      //mysql_query("DELETE FROM online WHERE correo = '$correo'",$link);
      mysql_query("insert into online(foto,id_usu,nombre,fecha,sexo,edad,emision,bondage,zona,codigo,audiencia) values('$foto','$id_usu','$nombre','$fecha','$sexo','$edad','$emision','$bondage','$zona','$codigo','$audiencia')",$link);
    }

    if(isset($_GET["k"])){
      mysql_query("DELETE FROM online WHERE id_usu = '$id_usu'",$link);
      @unlink("chat/$usu.html");
    }

    $result = mysql_query("SELECT * FROM online WHERE id_usu = '$id_usu'", $link);
    if (@$row = mysql_fetch_array($result)){
      //Aqui supongo que una vez guardados los datos, redirige a pagina de perfil.
      ?>
      <h2 style="text-align:center; color:green;">Ahora estas retransmitiendo | <a href="index.php?m=44&k=1"><font color="red" size="4px">DESCONECTAR</font></a></h2>
      <?php

      //$ar=fopen("chat/".$usu.".html","a") or die("Problemas en la creacion");
      ?>
      <h1 style="margin-left: 55px; color:#c61863; font-size:1.9em;">$row[3]</h1>
      <div class="marco_video">$row[10]</div>
      <br /><br />
      <div class="charcue">
        <div id="chatbox"></div>
        <div align="center">
          <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg" size="60" />
            <input name="submitmsg" type="submit" id="submitmsg" value="Enviar" class="botonchat" />
          </form>
        </div>
      </div>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
      <script type="text/javascript">
        // jQuery Document
        $(document).ready(function(){
        	//If user submits the form
        	$("#submitmsg").click(function(){
        		var clientmsg = $("#usermsg").val();
        		$.post("chat/postea.php?id=$id_usu", {text: clientmsg});
        		$("#usermsg").attr("value", "");
        		return false;
        	});

          //Load the file containing the chat log
        	function loadLog(){
            $.ajax({
              url: "chat/$row[3].html",
              cache: false,
              success: function(html){
                $("#chatbox").html(html); //Insert chat log into the #chatbox div
              },
            });
        	}

          //Load the file containing the chat log
          function loadLog(){
		        var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
            $.ajax({
              url: "chat/$row[3].html",
              cache: false,
              success: function(html){
                $("#chatbox").html(html); //Insert chat log into the #chatbox div

                //Auto-scroll
                var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
                if(newscrollHeight > oldscrollHeight){
                  $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                }
              }
            });
          }

          setInterval (loadLog, 2500);	//Reload file every 2500 ms or x ms if you w
        });
      </script>
      <?php
      //if(isset($_GET["g"])){if($_GET["g"] == 1){echo $this->pregunta();}else{}}else{}              #&g=1

      ?>
      <div id="camera">
        <span class="tooltip"></span>
        <span class="camTop"></span>
        <div id="screen"></div>
        <div id="buttons">
          <div class="buttonPane" style="margin-top:45px;">
            <a id="shootButton" href="" class="blueButton">Foto!</a>
          </div>
          <div class="buttonPane">
            <a id="cancelButton" href="" class="blueButton">Cancelar</a> <a id="uploadButton" href="" class="greenButton">Subir!</a>
          </div>
        </div>
        <span class="settings"></span>
      </div>
      <div class="marconoti">
        <div class="notifica">
          <a href="mailto:support@lubricam.com?subject=Incidencia">Notificar incidencia o infracci&oacute;n</a>
        </div>
      </div>
      <?php

        $this->decripauditor($id);

    }else{ ?>

      <div align="center">
        <div class="marfor1">
          <div align="left">
            <h1 style="margin: 5px; color:#c61863; font-size:1.9em;">Mi show privado</h1>
            <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
            <form method="post" action="index.php?m=44" name="formretrans">
              <div class="form-group">
                <p>SEXO:</p>
                <select name="sexo" tabindex="1" class="form-control" required>
                  <option value="">Seleccionar</option>
                  <option>Mujer</option>
                  <option>Hombre</option>
                  <option>Pareja</option>
                  <option>Transexual</option>
                  <option>Bondage</option>
                  <option>En grupo</option>
                </select>
              </div>
              <div class="form-group">
                <p>EDAD:</p>
                <select name="edad" tabindex="2" class="form-control" required>
                  <option value="">Seleccionar</option>
                  <option value="18 / 20"> 18 / 20 </option>
                  <option value="20 / 30"> 20 / 30 </option>
                  <option value="30 / 40"> 30 / 40 </option>
                  <option value="40 / 50"> 40 / 50 </option>
                  <option value="Mas de 50"> M&aacute;s de 50 </option>
                </select>
              </div>  
              <div class="form-group">
                <p>EMISI&Oacute;N:</p>
                <select name="emision" tabindex="3" class="form-control" required>
                  <option value="">Seleccionar</option>
                  <option value="Webcam Hd"> Webcam Hd </option>
                  <option value="Webcam clasicas"> Webcam cl&aacute;sicas </option>
                </select>
              </div>  
              <div class="form-group">
                <p>BONDAGE:</p>
                <select name="bondage" tabindex="4" class="form-control" required>
                  <option value="">Seleccionar</option>
                  <option> Estilo Bondage </option>
                  <option> Sin Bondage </option>
                </select>
              </div>
              <div class="form-group">
                <p>ZONA:</p>
                <select name="zona" tabindex="5" class="form-control" required>
                  <option value="">Seleccionar</option>
                  <option value="America del norte"> Am&eacute;rica del norte </option>
                  <option value="America del sur y central"> Am&eacute;rica del sur y central </option>
                  <option value="Europa / Rusia"> Europa / Rusia </option>
                  <option value="Africa y otras regiones"> &Aacute;frica y otras regiones </option>
                  <option value="Asia / Oceania"> Asia / Ocean&iacute;a </option>
                </select>
              </div>
              <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
              <p class="texthead" style="margin-bottom:-19px;">C&oacute;digo del video en Streaming:</p><br />
              <textarea name="codigo" class="form-control" style="width:90%; height:175px;" placeholder="Ejemplo: <iframe width=560 height=315 src=www..." required></textarea>
              <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
              <input type="submit" name="enviar" value="Retransmitir ahora!" class="btn btn-primary btn-lg">
              <br /><br /><br />
            </form>
          </div>
        </div>
      </div>
      <?php
    }
  }

  function cabecera(){
    $this->IniciaSesion();
    $this->monedero();

    ?>

    <!DOCTYPE html>
    <html lang="es">
      <head>
        <meta charset="utf-8" />
        <?php

          $this->meta_tags();
          $this->scripts();

        ?>
      </head>
      <body>

    <?php
  }

  function sacadato($dato, $tabla){
    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link = mysql_connect("localhost", 'root', '');
    mysql_select_db($this->db, $link);
    $correo = $this->sacacorre();
    $result = mysql_query("SELECT * FROM $tabla WHERE correo = '$correo'", $link);
    if (@$row = mysql_fetch_array($result)){
      return $row[$dato];
    } else { return 0; }
    mysql_close($link);
  }
     
  function consulta($consu){
    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link=mysql_connect("localhost", 'root', '');
    mysql_select_db($this->db, $link);
    $result = mysql_query($consu, $link);
    if ($result){ return true; } 
    else { return false; }
    mysql_close($link);
  }

  function busca(){ ?>
    <form action="index.php?m=55" method="post" name="FormBusca">
      <div class="col-lg-4">
        <label>SEXO</label>
        <select name="sexo" tabindex="1" class="form-control">
          <option value="">Todos</option>
          <option value="Mujer">Mujeres</option>
          <option value="Hombre">Hombres</option>
          <option value="Pareja">Parejas</option>
          <option value="Transexual">Transexuales</option>
          <option value="Bondage">Bondage</option>
          <option value="En grupo">En grupo</option>
        </select>
        <label>EDAD</label>
        <select name="edad" tabindex="2" class="form-control">
          <option value=""> Todas </option>
          <option value="18 / 20"> 18 / 20 </option>
          <option value="20 / 30"> 20 / 30 </option>
          <option value="30 / 40"> 30 / 40 </option>
          <option value="40 / 50"> 40 / 50 </option>
          <option value="Mas de 50"> M&aacute;s de 50 </option>
        </select>
      </div>
      <div class="col-lg-4">
        <label>EMISI&Oacute;N</label>
        <select name="emision" tabindex="3" class="form-control">
          <option value=""> Todos </option>
          <option value="Webcam Hd"> Webcam Hd </option>
          <option value="Webcam clasicas"> Webcam cl&aacute;sicas </option>
        </select>
        <label>BONDAGE</label>
        <select name="bondage" tabindex="4" class="form-control">
          <option value=""> Todos </option>
          <option> Estilo Bondage </option>
          <option> Sin Bondage </option>
        </select>
      </div>
      <div class="col-lg-4">
        <label>ZONA</label>
        <select name="zona" tabindex="5" class="form-control">
          <option value=""> Todos </option>
          <option value="America del norte"> Am&eacute;rica del norte </option>
          <option value="America del sur y central"> Am&eacute;rica del sur y central </option>
          <option value="Europa / Rusia"> Europa / Rusia </option>
          <option value="Africa y otras regiones"> &Aacute;frica y otras regiones </option>
          <option value="Asia / Oceania"> Asia / Ocean&iacute;a </option>
        </select>
        <label>ORDENAR</label>
        <select name="orden" tabindex="6" class="form-control">
          <option value=""> Todos </option>
          <option value="asc"> Por edad ascendente </option>
          <option value="desc"> Por popularidad </option>
        </select>
      </div>
      <div class="col-lg-4">
        <hr>
        <div>
          <button type="submit" class="btn btn-default" style="width: 100%;">Buscar</button>
           <!-- <p class="btn btn-default" style="width:220px; height:35px; font-color:#000;" class="dropdown-toggle" data-toggle="dropdown"> - C e r r a r - </p>-->
        </div>
      </div>
    </form>
    <?php
  }

  function buscador(){
    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link = mysql_connect("localhost",'root','');
    mysql_select_db($this->db, $link);

    if($_POST["orden"] == "")
      $ordenado = "DESC";
    else
      $ordenado = $_POST["orden"];

    @$result = mysql_query("SELECT * FROM online WHERE
                    sexo LIKE '%{$_POST[sexo]}%' AND
                    edad LIKE '%{$_POST[edad]}%' AND
                    emision LIKE '%{$_POST[emision]}%' AND
                    bondage LIKE '%{$_POST[bondage]}%' AND
                    zona LIKE '%{$_POST[zona]}%'
                    order by audiencia $ordenado", $link);


    while (@$row = mysql_fetch_array($result)){
      $nuaud = $this->sacaaudi($row[2]);
      // var_dump( $row );
      $urlfot = "http://www.lubricam.com/$row[1]";
      $fotoname = "$row[1]";

      if ($this->verificafoto($urlfot))
        $ImaGe = $fotoname;
      else
        $ImaGe = "img/imgnodisponible.jpg";

      ?>
      <div align="center">
        <a href="index.php?m=99&id=<?= $row[2] ?>">
          <div class="markvid">
            <div class="BanMVTop">
              <b>Audiencia: <?= $nuaud ?></b>
            </div>
            <img src="<?= $ImaGe ?>" width="100%" height="100%" style="margin: -25px 0 0 0;">
            <div class="BanMVbottom">
              <div style="text-align:left; margin-left:5px; float:left;"><?= $row[3] ?></div>
              <div style="text-align:right; margin-right:5px; float:right;">Edad: <?= $row[6] ?></div>
            </div>
          </div>
        </a>
      </div>
      <?php
    }
    
    $Nfilas = mysql_num_rows($result);

    if($Nfilas == 0){ ?>
      <h3 style="text-align:center;">No se han encontrado resultados.</h3>
      <?php
    }
  }

  function cuerpo(){ ?>
    <!-- Header Page -->
    <header>
      <div class="cabecera">
        <div class="container">
          <div class="content_logo">
            <a href="<?= $this->path_route ?>">
              <img src="img/logo.jpg" class="logo_text" />
            </a>
          </div>

          <div class="idioma">
            <ul id="menu_idioma" style="list-style:none;">
              <li>
                <a href="#">
                  <img src="img/bandera-espana.png" style="padding:4px;">
                </a>
                <ul id="sub_menu_idioma" style="margin-top:-25px;">
                  <li>
                    <a href="#">
                      <img src="img/bandera-espana.png" style="padding:4px;">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="img/bandera-inglaterra.png" style="padding:4px;">
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

          <?php

          if(!isset($_SESSION["codtemp"])){ ?>
            <div class="como_funciona">
              <a id="tip5" title="Login" href="#login_form" style="margin-top:2px;color:#1e1c11;">Entra</a> | 
              <a href="#registro_form" id="regis"  alt="Registro" title="Registro" style="margin-top:2px;color:#ff4b4b;">Registrate</a>
            </div>
            <?php 
          }
              <!-- <img style="margin:0;"src="img/b-d.png"/> -->
            </div>
          <?php }
          
          if(isset($_SESSION["codtemp"])){

            $this->controlaudi();

            $usu = $this->sacadato("1", "registro");
            $fichas = $this->sacadato("1", "creditos"); //Esta ahora sobra
            $nombre_usu = ucfirst($usu);
          ?>
            <div class="menusu">
              <ul id="menu_usuario" style="list-style:none;">
                <li>
                  <a class="font:Arial;font-size:10;" href="#"> 
                    <?php
                      $text_bold = "";
                      $text_bold = $fichas <= 0 ? '<span style="color: #E61108;font-size:0.7em;"><b>'.$nombre_usu.'</b> | </span><b style="color:#E61108; font-size:0.7em;">NO DISPONE DE TOKENS</b>' : '<span style="color: #111;"><b>'.$nombre_usu.'</b> | </span><b style="color: #111;"><b id="myWatch"></b> Tokens</b>';

                      echo $text_bold. "&nbsp;&nbsp;&nbsp;<img src='img/b-d.png' />";
                      $text_bold = $fichas <= 0 ? '<span style="color: #E61108;font-size:0.7em;"><b>'.$nombre_usu.'</b> | </span><b style="color:#E61108; font-size:0.7em;">NO DISPONE DE TOKENS</b>' : '<span style="color: #0086D1;"><b>'.$nombre_usu.'</b> | </span><b>Tokens: <b id="myWatch"></b></b>';

                      echo $text_bold;
                    ?></a>
                  <!-- <li><a href="index.php?m=66">Configuraci&oacute;n</a></li> -->
                  <!-- <li><a href="index.php?m=">Blog LubriCam</a></li> -->
                <ul id="sub_menu_usuario">
                  <li>
                    <a href="index.php?m=77">Mi Perfil</a>
                  </li>
                  <li>
                    <a href="index.php?m=33">Recarga Tokens</a>
                  </li>
                  <li>
                    <a href="index.php?m=22">Cobrar Tokens</a>
                  </li>
                  <li>
                    <a href="faqs.html">Preguntas frecuentes</a>
                  </li>
                  <li>
                    <a href="index.php?m=support">Soporte</a>
                  </li>
                  <li>
                    <a href="index.php?m=88">Cerrar Sesi&oacute;n</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
<!-- 
          <a href="index.php?m=77">
            <div class="fichas_gratis">MI PERFIL</div>
          </a> -->

          <?php 
          } 
          ?>

          <div class="markmenu">
            <nav>
              <?php echo $this->enlaces(); ?>
            </nav>
          </div>
        </div>
      </div><!-- Final de cabecera -->
    </header>
    <!-- Body Page -->
    <div>
      <div class="cuerpo">

        <?php

        $this->mostrar_enlaces();

        ?>
      </div>
    </div>
        <?php
  }

  function cuerpo2(){ ?>
    <header>
      <div class="cabecera">
        <a href="index.php">
          <div class="logo_text"></div>
        </a>
        <div class="idioma">
          <ul id="menu_idioma" style="list-style:none;">
            <li>
              <a href="#">
                <img src="img/bandera-espana.png" style="padding:4px;">
              </a>
              <ul id="sub_menu_idioma" style="margin-top:-25px;">
                <li>
                  <a href="#">
                    <img src="img/bandera-espana.png" style="padding:4px;">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="img/bandera-inglaterra.png" style="padding:4px;">
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="como_funciona">
          <a id="tip5" title="Login" href="#login_form" style="margin-top:2px;color:#1e1c11;">Entra</a> | 
          <a href="#registro_form" id="tip5"  alt="Registro" title="Registro" style="margin-top:2px;color:#ff4b4b;">Registrate</a>
          <a>
            <img style="margin-left:3px;margin-top:2px;"src="img/b-d.png"/>
          </a>
        </div>
        <?php
        if(isset($_SESSION["codtemp"])){
          $this->controlaudi();
          $usu = $this->sacadato("1", "registro");
          $fichas = $this->sacadato("1", "creditos"); //Esta ahora sobra
          $nombre_usu = ucfirst($usu);
          ?>
          <div class="menusu">
            <ul id="menu_usuario" style="list-style:none;">
              <li>
                <a href="#"> <?= $nombre_usu ?><b> </b> | <b> </b> <b> </b>
                  <?php
                  if($fichas <= 0){ ?>
                    <b style="color:#FF0000; font-size:0.7em;">NO DISPONE DE TOKENS</b>
                  <?php
                  }else{ ?>
                    Tokens: <b id='myWatch'></b>
                  <?php
                  } ?>
                </a>
                <ul id="sub_menu_usuario">
                  <li>
                    <a href="index.php?m=77">Mi Perfil</a>
                  </li>
                  <li>
                    <a href="index.php?m=33">Recarga Tokens</a>
                  </li>
                  <li>
                    <a href="index.php?m=22">Cobrar Tokens</a>
                  </li>
                  <li>
                    <a href="faqs.html">Preguntas frecuentes</a>
                  </li>
                  <li>
                    <a href="index.php?m=88">Cerrar Sesi&oacute;n</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <a href="index.php?m=77"><div class="fichas_gratis">MI PERFIL</div></a>
          <?php
        } ?>

        <div class="markmenu">
          <nav> 
          <?php    
            echo $this->enlaces();
          ?>
          </nav>
        </div>
      </div><!-- Final de cabecera -->
    </header>
    <secction>
      <div class="cuerpo">
      <?php
        $this->mostrar_soporte();
      ?>
      </div>
    </secction>
    <?php
  }

  function pie(){

    $year = date('Y');

    ?>
    <footer>
<<<<<<< HEAD
=======
      <div id="pie" class="pie">	 
        <!-- aplicando ventana de transmitete -->
        <div  id="caja2" style="padding:0px;" >
          <form id="retrans" method="post" action="#retrans"  style="background-image:url(img/emitir.png);">	
            <p id="login_error" style="font:calibri(Body) #1E1C11;font-size:20px;font-weight:bold;">
              <font style="margin-left:150px;">Aviso Legal en Retransmisi&oacuten</font>
            </p>
  		      <div style="width:707px;height:150px;margin-left: auto;margin-right: auto;background:white;border:#BFBFBF;">
  		        <p style="color:#00B0F0;font:calibri(Body);font-weight:bold;margin-legt:12px;">
                T&eacuterminos y condiciones
              </p>
  	          <p style="font:calibri(Body)  #1E1C11 ;font-size:10px;margin-left:8px;margin-right:8px;">
                Este sitio web contiene informaci&oacuten, enlaces, im&aacutegenes y v&iacutedeos de contenido sexual expl&iacutecito (colectivamente, el "material sexualmente expl&iacutecito"). No contin&uacutee si: (i) que no son por lo menos 18 años de edad o mayores de edad en cada jurisdicci&oacuten en la que se debe o puede ver el material sexualmente expl&iacutecito, el que sea mayor (la "mayor&iacutea de edad") , (ii) dicho material le ofende, o (iii) de ver el material sexualmente explícito no es legal en todos y cada comunidad donde se elige para visualizarla.
                Al optar por entrar en este sitio web usted est&aacute afirmando que las siguientes declaraciones son verdaderas y correctas:
                He alcanzado la mayoría de edad en mi jurisdicci&oacuten;
                El material sexualmente expl&iiacutecito que voy a ver es para mi uso personal y no expondr&ecute los menores a dicho material;
                He alcanzado la mayor&iacutea de edad en mi jurisdicci&oacuten;
              </p>
  		      </div>
  		      <p style="margin-left:40px;margin-top:20px;">
              <input type="submit" value="Salir" style="border-radius: 1px 1px 1px 1px;-moz-border-radius: 1px 1px 1px 1px;-webkit-border-radius: 1px 1px 1px 1px;border: 0px solid #000000;"class="c3" onclick="closebox()" />
              <input type="submit" value="Entrar" class="c2" style="margin-left:5px;border-radius: 1px 1px 1px 1px;-moz-border-radius: 1px 1px 1px 1px;-webkit-border-radius: 1px 1px 1px 1px;border: 0px solid #000000;" onclick="window.location.href('index.php?m=44');" />
  		      </p>
            <p style="margin-left:150px;">
              <img style="margin-left:auto;margin-right:auto;" src="./img/seguridad.png"/>
            </p>
          </form>
        </div>
        <!-- //Contacta con nosotros -->
        <!-- //Finaliza Soporte -->
      </div>
      <div class="textpie">
        <a href="faqs.html#Nuestros%20T%C3%A9rminos%20y%20Condiciones%20de%20Uso"> Empresa y Equipo</a><a> | </a>
        <a href="faqs.html#Nuestra%20Pol%C3%ADtica%20de%20Privacidad%20y%20Protecci%C3%B3n%20de%20Datos"> &#191;C&oacutemo funciona&#63;</a><a> | </a>
        <a href="soporte.php" id="c"  >Contactar con nosotros</a><a> | </a>
        <a href="mailto:bajas@lubricam.com?subject=Eliminar cuenta">Ganar dinero</a><a> | </a>
        <a href="faqs.html#Nuestros%20T%C3%A9rminos%20y%20Condiciones%20de%20Uso"> Noticias y Blog</a><a> | </a>
        <a href="faqs.html#Nuestra%20Pol%C3%ADtica%20de%20Privacidad%20y%20Protecci%C3%B3n%20de%20Datos">Facturaci&oacuten</a><a> | </a>
        <a href="faqs.html#Nuestras%20cookies">Eliminar cuenta</a><a> | </a>
        <a href="mailto:bajas@lubricam.com?subject=Eliminar cuenta">Ganar dinero</a><a> | </a>
        <br />
        <img src="logotipos/fc.jpg"/><img src="logotipos/tw.jpg"/><img src="logotipos/g+.jpg"/>
        <br/>  
        &#64; LubriCam Ltd <?= $year ?>
        <a href="#terms">T&eacuterminos y condiciones</a><a> | </a>
        <a href="mailto:info@lubricam.com?subject=Contacto">Pol&iacutetica de Privacidad</a><a> | </a>
        <a href="index.php?m=44">Pol&iacutetica de Cookies </a>
      </div>
    </footer>

        <!-- Inicio de los POPUPS -->
        <?php include 'includes/popups.php'; ?>
        <!-- FIN de los POPUPS -->

        <script src="data/bootstrap.min.js"></script>
        <script src="data/holder.js"></script>
        <script src="assets/fancybox/jquery.easing-1.3.pack.js"></script>
        <script src="assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <script src="assets/webcam/webcam.js"></script>
        <script src="assets/js/script.js"></script>
        <script src="assets/js/constr.js"></script>
      </body>
    </html>
    <?php
  }     
     
  function mostrarvideo($a1){
    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link = mysql_connect("localhost",'root','');
    mysql_select_db($this->db, $link);

    $result = mysql_query("SELECT * FROM online WHERE id_usu = '$a1'", $link);
    if (@$row = mysql_fetch_array($result)){
     echo $row[10];
    }else{}
  }
     
  function auditor($id){
    $correo = @$this->sacacorre();

    if(isset($id)){      
    }elseif(isset($_GET["id"])){
      $id = $_GET["id"];
    }

    //Descontamos un token al entrar.
    if(isset($_SESSION["codtemp"])){
      $usuario = $this->sacadato("1", "registro");
      //Redirecciona si no tiene fichas y entra en pagina auditor
      $creditos = $this->sacadato("fichas", "creditos");
      if($creditos <= 0){ ?>
        <meta http-equiv="refresh" content="0;URL=index.php">
      <?php
      }
    }else{
      $correo = "";
      $usuario = "";
    }

    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link = mysql_connect("localhost",'root','');
    mysql_select_db($this->db, $link);
    //$correo = $this->sacacorre();

    $result = mysql_query("SELECT * FROM perfil WHERE id = '$id'", $link);
    
    if (@$row = mysql_fetch_array($result)){
      if($correo == $row[1]){ ?>
        <meta http-equiv="refresh" content="0;URL=index.php?m=44">
      <?php
      }
      ?>

      <input type="hidden" value="myToken">
      <h1 style="margin-left: 55px; color:#c61863; font-size:1.9em;"><?= $row[3] ?></h1>
      <div class="marco_video">
        <?php echo $this->mostrarvideo($a1=$id); ?>
      </div>
      <?php

      if(isset($_SESSION["codtemp"])){
        $usuchat = $this->sacadato("1", "registro");
        $_SESSION['name'] = stripslashes(htmlspecialchars($usuchat));
      }
      if(!isset($_SESSION['name'])){
        // loginForm();
      }else{
        $temnom = $_SESSION['name'];
        ?>
        <div class="charcue">
          <div id="chatbox"></div>
          <div align="center">
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" size="60" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Enviar" class="botonchat" />
            </form>
          </div>
          <div style="vertical-align:top; margin:5px 5px 5px 0px;">
            <form name="message" action="">
              <select name="userdona" id="userdona" style="width:auto; display: inline-block; border:1px solid #000; width:auto;" class="form-control">
                <option value="10">10 Tokens</option>
                <option value="50">50 Tokens</option>
                <option value="100">100 Tokens</option>
                <option value="500">500 Tokens</option>
                <option value="1000">1000 Tokens</option>
              </select>
              <input name="submitdona" type="submit" id="submitdona" value="Donar ahora" class="botondona" />
            </form>
          </div>
        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <script type="text/javascript">
          //cargamos la funcion para mostrar contenido oculto
          function hideOrShowPassword(){ // Si quieres le cambias el nombre xD
            checkbox = document.getElementById('ojo');
            passField = document.getElementById('pass');
            if(checkbox.checked==true) // Si la checkbox de mostrar contraseña está activada
                passFiled.type = "text";
            else // Si no está activada
                passField.type = "password"
          }

          // jQuery Document
          $(document).ready(function(){
            //cargamos soporte
            $("#c").click(function() {
              $("#contacta").show()
            });
            
            //cargamos ventana
            openbox('da igual', 1).delay(800);

  	         //If user submits the form
            $("#submitmsg").click(function(){
            	var clientmsg = $("#usermsg").val();
            	$.post("chat/postea.php?id=$id", {text: clientmsg});
            	$("#usermsg").attr("value", "");
            	return false;
            });
  	
          	//If user submits the form
          	$("#submitdona").click(function(){
          		var clientdona = $("#userdona").val();
          		$.post("chat/postea.php?id=$id", {userdona: clientdona});
          		$("#userdona").attr("value", "");
          		return false;
          	});

          	//Load the file containing the chat log
          	function loadLog(){
          		$.ajax({
          			url: "chat/$row[3].html",
          			cache: false,
          			success: function(html){
          				$("#chatbox").html(html); //Insert chat log into the #chatbox div
          		  	},
          		});
          	}

          	//Load the file containing the chat log
          	function loadLog(){
          		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
          		$.ajax({
          			url: "chat/$row[3].html",
          			cache: false,
          			success: function(html){
          				$("#chatbox").html(html); //Insert chat log into the #chatbox div

          				//Auto-scroll
          				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
          				if(newscrollHeight > oldscrollHeight){
          					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
          				}
          		  	},
          		});
          	}

            setInterval (loadLog, 2500);	//Reload file every 2500 ms or x ms if you w
          });
        </script>
        <?php
      } ?>

      <div class="marconoti">
        <div class="notifica">
          <a href="mailto:support@lubricam.com?subject=Incidencia">Notificar incidencia o infracci&oacute;n</a>
        </div>
      </div> 
      <?php

      $this->decripauditor($_GET["id"]);

      //$audi = $this->consulta("SELECT * FROM online WHERE correo = '$correo'");
      $audi = $this->sacaaudi($id);
      $audmas = $audi+1;
      
      if($correo){
        $this->consulta("UPDATE online SET audiencia = '$audmas' WHERE id_usu = '$id'");
        $this->consulta("INSERT INTO contaud (correo,id_usu) VALUES ('$correo','$id')");
      }
    }
  }

  function sacaaudi($id){
    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link = mysql_connect("localhost",'root','');
    mysql_select_db($this->db, $link);
    //$correo = $this->sacacorre();
    $result = mysql_query("SELECT * FROM online WHERE id_usu = '$id'", $link);
    if (@$row = mysql_fetch_array($result)){
      return $row[11];
    } else { return 0; }
    mysql_close($link);
  }

  function controlaudi(){
    $correo = $this->sacacorre();
    if(isset($_GET["m"])){
      if($_GET["m"] == "99"){
      }else{
        //Comprobar si tiene registro, descontar 1 del auditor donde lo tenga y borrar registro.
        #$link = mysql_connect("localhost",$this->user,$this->pass);
        $link=mysql_connect("localhost", 'root', '');
        mysql_select_db($this->db, $link);
        
        $result = mysql_query("SELECT * FROM contaud WHERE correo = '$correo'", $link);
        if(@$row = mysql_fetch_array($result)){
          $audi = $this->sacaaudi($row[1]);
          $audmen = $audi-1;
          $this->consulta("UPDATE online SET audiencia = '$audmen' WHERE id_usu = '$row[1]'");
          $this->consulta("DELETE FROM contaud WHERE correo = '$correo'");

        }
        mysql_close($link); 
      }
    }else{
      #$link = mysql_connect("localhost",$this->user,$this->pass);
      $link=mysql_connect("localhost", 'root', '');
      mysql_select_db($this->db, $link);

      $result = mysql_query("SELECT * FROM contaud WHERE correo = '$correo'", $link);
      if(@$row = mysql_fetch_array($result)){
        $audi = $this->sacaaudi($row[1]);
        $audmen = $audi-1;
        $this->consulta("UPDATE online SET audiencia = '$audmen' WHERE id_usu = '$row[1]'");
        $this->consulta("DELETE FROM contaud WHERE correo = '$correo'");
      }
      mysql_close($link);
    }
  }

  function formtrans(){
    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link=mysql_connect("localhost", 'root', '');
    mysql_select_db($this->db, $link);
    $correo = $this->sacacorre();
            
    if(isset($_POST["enviar"])){
      $id = $_SESSION["numus"];
      //$edadanyo = $anyoac-$_POST["anyo"];
      $edad = $_POST["dia"]."-".$_POST["mes"]."-".$_POST["anyo"];
      $alias = $_POST["alias"];
      $idioma = $_POST["idioma"];
      $pais = $_POST["pais"];
      $localidad = $_POST["localidad"];
      $detalles = $_POST["detalles"];
      $descripcion = $_POST["descripcion"];

      mysql_query("DELETE FROM perfil WHERE correo = '$correo'",$link);

      mysql_query("insert into perfil
                (id,correo,edad,alias,idioma,pais,localidad,detalles,descripcion) values
                ('$id','$correo','$edad','$alias','$idioma','$pais','$localidad','$detalles','$descripcion')",$link);

      ?>
      <h2 style="text-align:center; color:green;">Los cambios se han actualizado</h2>
      <?php
    }
            
    $result = mysql_query("SELECT * FROM perfil WHERE correo = '$correo'", $link);

    if (@$row = mysql_fetch_array($result)){ ?>
      <div align="center">
        <div class="marfor1">
          <div align="left">
            <h1 style="margin: 5px; color:#c61863; font-size:1.9em;">Edita tu perfil</h1>
            <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
            <form method="post" name="formactu">
              <div class="form-group">
                <label>Fecha de nacimiento ( Ejemplo: 1 / 1 / 1980 )</label> <br />
                <?php

                $sepa = explode("-", $row[2]);
                //echo $sepa[0]; // dia
                //echo $sepa[1]; // mes
                //echo $sepa[2]; // anyo
                $anyoac = date("Y");

                if(isset($sepa[2]))
                  $edad = $anyoac-$sepa[2];
                else
                  $edad = "";

                ?>

                <select name='dia' style='width:75px; display: inline-block; margin-right:25px;' class='form-control' required>
                  <option value=''>D&iacute;a</option>
                  <?php
                  for($x=1; $x<32; $x++){
                    if($x == $sepa[0]){ ?>
                      <option value='<?= $x ?>' selected><?= $x ?></option> <?php
                    }else{ ?>
                      <option value='<?= $x ?>'><?= $x ?></option> <?php 
                    }
                  } ?>
                </select>

                <select name='mes' style='width:75px; display: inline-block; margin-right:25px;' class='form-control' required>
                  <option value=''>Mes</option> <?php
                  for($x=1; $x<13; $x++){
                    if($x == $sepa[1]){ ?>
                      <option value='<?= $x ?>' selected><?= $x ?></option>  <?php
                    }else{ ?>
                      <option value='<?= $x ?>'><?= $x ?></option> <?php
                    }
                  } ?>
                </select>

                <select name='anyo' style='width:125px; display: inline-block;' class='form-control' required>
                  <option value=''>A&ntilde;o</option> <?php
                  $k1 = date("Y");
                  $k2 = $k1-18;
                  for($x=$k2; $x>=1915; $x--){
                    if($x == $sepa[2]){ ?>
                      <option value='<?= $x ?>' selected><?= $x ?></option> <?php
                    }else{ ?>
                      <option value='<?= $x ?>'><?= $x ?></option> <?php
                    }
                  } ?>
                </select><br />

                <font style="color:#c0c0c0; font-size:12px;">
                  * La fecha de nacimiento aqu&iacute; indicada debe coincidir con tus datos de compra o cobro de tokens para evitar errores de verificaci&oacute;n de usuario.
                </font>
              </div>
              <div class="form-group">
                <label>Alias</label>
                <input type="text" class="form-control" id="alias" name="alias" value="$row[3]" placeholder="Introduce tu alias" required>
              </div>
              <div class="form-group">
                <label>Idioma natal:</label>
                <input type="text" class="form-control" id="idioma" name="idioma" value="$row[4]" placeholder="Introduce tu idioma natal" required>
              </div>
              <div class="form-group">
                <label>Pa&iacute;s:</label>
                <input type="text" class="form-control" id="pais" name="pais" value="$row[5]" placeholder="Introduce tu pa&iacute;s">
              </div>
              <div class="form-group">
                <label>Localidad:</label>
                <input type="text" class="form-control" id="localidad" name="localidad" value="$row[6]" placeholder="Introduce tu localidad">
              </div>
              <div class="form-group">
                <label>Tatoos, Piercing?:</label>
                <textarea class="form-control" name="detalles">$row[7]</textarea>
              </div>
              <div class="form-group">
                <label>Acerca de mi:</label>
                <textarea class="form-control" name="descripcion">$row[8]</textarea>
              </div>
              <br /><br />
              <input type="submit" name="enviar" value="Actualizar" class="btn btn-primary btn-lg">
            </form>
          </div>
        </div>
        <?php
        // Mostrar todos los datos del perfil
        ?>
        <div class="marfor2">
          <div align="left">
            <h1 style="margin: 5px; color:#c61863; font-size:1.9em;">As&iacute; te ver&aacute;n</h1>
            <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
            <div class="columnauno">
              <div class="filauno">
                <p class="textfiluno">Alias:</p>
              </div>
            </div>
            <div class="columnados">
              <div class="filauno">$row[3]</div>
            </div>
            <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
            <div class="columnauno">
              <div class="filauno">
                <p class="textfiluno">Edad:</p>
              </div>
            </div>
            <div class="columnados">
              <div class="filauno">$edad</div>
            </div>
            <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
            <div class="columnauno">
              <div class="filauno">
                <p class="textfiluno">Idioma natal:</p>
              </div>
            </div>
            <div class="columnados">
              <div class="filauno">$row[4]</div>
            </div>
            <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
            <div class="columnauno">
              <div class="filauno">
                <p class="textfiluno">Pa&iacute;s:</p>
              </div>
            </div>
            <div class="columnados">
              <div class="filauno">$row[5]</div>
            </div>
            <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
            <div class="columnauno">
              <div class="filauno">
                <p class="textfiluno">Localidad:</p>
              </div>
            </div>
            <div class="columnados">
              <div class="filauno">$row[6]</div>
            </div>
            <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">    
            <div class="columnauno">
              <div class="filauno">
                <p class="textfiluno">Tatoos, Piercing?:</p>
              </div>
            </div>
            <div class="columnados">
              <div class="filauno">$row[7]</div>
            </div>
            <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
            <div class="columnauno">
              <div class="filauno">
                <p class="textfiluno">Descripci&oacute;n:</p>
              </div>
            </div>
            <div class="columnados">
              <div class="filauno">$row[8]</div>
            </div>
            <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
          </div>
        </div>
      </div>
      <?php
    }
    mysql_close($link);
  }
      
  function limpiar_caracteres_especiales($s) {
    $s = ereg_replace("[�����@]","a",$s);
    $s = ereg_replace("[�����]","A",$s);
    $s = ereg_replace("[����]","e",$s);
    $s = ereg_replace("[����]","E",$s);
    $s = ereg_replace("[����]","i",$s);
    $s = ereg_replace("[����]","I",$s);
    $s = ereg_replace("[������]","o",$s);
    $s = ereg_replace("[�����]","O",$s);
    $s = ereg_replace("[����]","u",$s);
    $s = ereg_replace("[����]","U",$s);
    $s = str_replace("[�]","&iquest;",$s);
    $s = str_replace("�","&ntilde",$s);
    $s = str_replace("�","&Ntilde;",$s);
    //para ampliar los caracteres a reemplazar agregar lineas de este tipo:
    //$s = str_replace(�caracter-que-queremos-cambiar�,�caracter-por-el-cual-lo-vamos-a-cambiar�,$s);

    return $s;
  }

  function decripauditor($id){

    // Mostrar todos los datos del perfil
    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link = mysql_connect("localhost",'root','');
    mysql_select_db($this->db, $link);
    //$correo = $this->sacacorre();

    $result = mysql_query("SELECT * FROM perfil WHERE id = '$id' LIMIT 0, 25", $link);
    
    if (@$row = mysql_fetch_array($result)){

      $sepa = explode("-", $row[2]);
      $anyoac = date("Y");
      if($row[2])
        $edad = $anyoac-$sepa[2];
      else
        $edad ="";

      $IdioNat = $this->limpiar_caracteres_especiales($row[4]);
      $Pais = $this->limpiar_caracteres_especiales($row[5]);
      $Localidad = $this->limpiar_caracteres_especiales($row[6]);
      $Tatoo = $this->limpiar_caracteres_especiales($row[7]);
      $Descrpcion = $this->limpiar_caracteres_especiales($row[8]);

      ?>
      <div class="marfor2" style="width:90%;">
        <div align="left">
          <h1 style="margin: 5px; color:#c61863; font-size:1.9em;">Perfil de <?= $row[3] ?></h1>
          <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
          <div class="columnauno">
            <div class="filauno">
              <p class="textfiluno">Alias:</p>
            </div>
          </div>
          <div class="columnados">
            <div class="filauno"><?= $row[3] ?></div>
          </div>
          <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
          <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Edad:</p></div>
          </div>
          <div class="columnados">
              <div class="filauno"><?= $edad ?></div>
          </div>
          <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
          <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Idioma natal:</p></div>
          </div>
          <div class="columnados">
              <div class="filauno"><?= $IdioNat ?></div>
          </div>
          <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
          <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Pa&iacute;s:</p></div>
          </div>
          <div class="columnados">
              <div class="filauno"><?= $Pais ?></div>
          </div>
          <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
          <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Localidad:</p></div>
          </div>
          <div class="columnados">
              <div class="filauno"><?= $Localidad ?></div>
          </div>
          <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
          <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Tatoos, Piercing?:</p></div>
          </div>
          <div class="columnados">
              <div class="filauno"><?= $Tatoo ?></div>
          </div>
          <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
          <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Descripci&oacute;n:</p></div>
          </div>
          <div class="columnados">
              <div class="filauno"><?= $Descrpcion ?></div>
          </div>
          <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
        </div>
      </div>
      <?php
    }
  }
      
  function logienla($enlo){
    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link = mysql_connect("localhost",'root','');
    mysql_select_db($this->db, $link);

    if(isset($enlo)){
      if($enlo == "1"){$result = mysql_query("SELECT * FROM online WHERE edad = '18 / 20' order by audiencia DESC", $link);}
      elseif($enlo == "2"){$result = mysql_query("SELECT * FROM online WHERE edad = '20 / 30' order by audiencia DESC", $link);}
      elseif($enlo == "3"){$result = mysql_query("SELECT * FROM online WHERE edad = '30 / 40' order by audiencia DESC", $link);}
      elseif($enlo == "4"){$result = mysql_query("SELECT * FROM online WHERE edad = '40 / 50' order by audiencia DESC", $link);}
      elseif($enlo == "5"){$result = mysql_query("SELECT * FROM online WHERE edad = 'Mas de 50' order by audiencia DESC", $link);}
      elseif($enlo == "6"){$result = mysql_query("SELECT * FROM online WHERE edad = ' ' order by audiencia DESC", $link);}

      //elseif($enlo == "7"){$result = mysql_query("SELECT * FROM online WHERE zona LIKE ' ' order by audiencia DESC", $link);}
      elseif($enlo == "8"){$result = mysql_query("SELECT * FROM online WHERE zona LIKE 'America del norte' order by audiencia DESC", $link);}
      elseif($enlo == "9"){$result = mysql_query("SELECT * FROM online WHERE zona LIKE 'America del sur y central' order by audiencia DESC", $link);}
      elseif($enlo == "10"){$result = mysql_query("SELECT * FROM online WHERE zona LIKE 'Europa / Rusia' order by audiencia DESC", $link);}
      elseif($enlo == "11"){$result = mysql_query("SELECT * FROM online WHERE zona LIKE 'Africa y otras regiones' order by audiencia DESC", $link);}
      elseif($enlo == "12"){$result = mysql_query("SELECT * FROM online WHERE zona LIKE 'Asia / Oceania' order by audiencia DESC", $link);}
      else{ echo "ERORR";}
    }else{echo "ERORR";}

    //    @$resultSTOP = mysql_query("SELECT * FROM online WHERE
    //            sexo LIKE '%{$_GET[sexo]}%' AND
    //            edad LIKE '%{$_GET[edad]}%' AND
    //            emision LIKE '%{$_GET[emision]}%' AND
    //            bondage LIKE '%{$_GET[bondage]}%' AND
    //            zona LIKE '%{$_GET[zona]}%'
    //            order by id $_GET[orden]", $link);

    while (@$row = mysql_fetch_array($result)){
      ?>
      <div align="center">
      <a href="index.php?m=99&id=<?= $row[2] ?>">
        <div class="markvid">
          <div class="BanMVTop"><b></b></div>
          <img src="$row[1]" width="100%" height="100%">
          <div class="BanMVbottom">
            <div style="text-align:left; margin-left:5px; float:left;"><?= $row[3] ?></div>
            <div style="text-align:right; margin-right:5px; float:right;">Edad:  <?= $row[6] ?></div>
          </div>
        </div>
      </a><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      <?php
    }
    
    $Nfilas = mysql_num_rows($result);

    if($Nfilas == 0){
    ?>
      <h3 style="text-align:center;">No se han encontrado resultados.</h3>
      <br /><br />
    <?php
    }
  }
      
  function verificafoto($foto){
    $file = "$foto";
    $file_headers = @get_headers($file);

    if($file_headers[0] == 'HTTP/1.1 404 Not Found')
      return false;
    else
      return true;
  }

  function demoos(){
    //Comprobamos las retranmisiones activas, las ordenamos por la cantidad de audiencia y mostramos los resultados X por p�g.
    //Extraemos los datos de la base de datos y los mostramos formando un marco por cada registro.
    // Paginadores de contenidos
    //

    if(isset($_GET["p"]))
      $pag = $_GET["p"]; 
    else
      $pag = "1";

    $hasta = 25; 
    $desde = ( $hasta * $pag ) - $hasta;

    #$link = mysql_connect("localhost",$this->user,$this->pass);
    $link = mysql_connect("localhost",'root','');
    mysql_select_db($this->db, $link);
    //$correo = $this->sacacorre();

    if(@$_GET["m"] == 1){
      //Aqui ordenar por popularidad (Los que mas audiencia tengan de todas las categorias).
      $result = mysql_query("SELECT * FROM online order by audiencia DESC LIMIT $desde, $hasta", $link);
      $linea = "select count(id) from online";
    }elseif(@$_GET["m"] == 2){
      $result = mysql_query("SELECT * FROM online WHERE sexo = 'Mujer' order by audiencia DESC LIMIT $desde, $hasta", $link);
      $linea="select count(id) from online WHERE sexo = 'Mujer'";
    }elseif(@$_GET["m"] == 3){
      $result = mysql_query("SELECT * FROM online WHERE sexo = 'Hombre' order by audiencia DESC LIMIT $desde, $hasta", $link);
      $linea="select count(id) from online WHERE sexo = 'Hombre'";
    }elseif(@$_GET["m"] == 4){
      $result = mysql_query("SELECT * FROM online WHERE sexo = 'Pareja' order by audiencia DESC LIMIT $desde, $hasta", $link);
      $linea="select count(id) from online WHERE sexo = 'Pareja'";
    }elseif(@$_GET["m"] == 5){
      $result = mysql_query("SELECT * FROM online WHERE sexo = 'Transexual' order by audiencia DESC LIMIT $desde, $hasta", $link);
      $linea="select count(id) from online WHERE sexo = 'Transexual'";
    }elseif(@$_GET["m"] == 6){
      $result = mysql_query("SELECT * FROM online WHERE sexo = 'Bondage' order by audiencia DESC LIMIT $desde, $hasta", $link);
      $linea="select count(id) from online WHERE sexo = 'Bondage'";
    }elseif(@$_GET["m"] == 7){
      $result = mysql_query("SELECT * FROM online WHERE sexo = 'En grupo' order by audiencia DESC LIMIT $desde, $hasta", $link);
      $linea="select count(id) from online WHERE sexo = 'En grupo'";
    }elseif(@$_GET["m"] == ''){
      $result = mysql_query("SELECT * FROM online order by audiencia DESC LIMIT $desde, $hasta", $link);
      $linea="select count(id) from online";
  					
      while (@$row = mysql_fetch_array($result)){
      	$nuaud = $this->sacaaudi($row[2]);
      	$urlfot = "http://www.lubricam.com/$row[1]";
      	$fotoname = "$row[1]";
      }

  		//if($row[1] == ""){ $ImaGe = "img/imgnodisponible.jpg"; }else{ $ImaGe = $row[1]; }

      if ($this->verificafoto($urlfot)) {$ImaGe = $fotoname;}else{$ImaGe = "img/imgnodisponible.jpg";}

      ?>
      <div class="container">
      <div align="center">
        <?php
        //$fotoname = 'uploads/original/'.md5($_SERVER['REMOTE_ADDR']).'.jpg';
        //$fotoname = 'uploads/original/'.$row[0].'.jpg';
        ?>
        <a href="index.php?m=99&id=<?= $row[2] ?>">
          <div class="markvid">
            
            <div class="content_image">
              <img src="<?= $ImaGe ?>" width="100%" height="100%">
            </div>
            
            <div class="description">
              <div class="first_row">
                <span class="name">Ernest</span>, 
                <span class="age">25</span>
              </div>

              <div class="second_row">
                <span class="time">114 min</span>, 
                <span class="viewers">2780 viewers</span>
              </div>

              <div class="third_row">
                <span class="country">Portugal</span>
              </div>
            </div>
<!--
            <div class="BanMVTop">
              <b>Audiencia: <?= $nuaud ?></b>
            </div>

            <div class="BanMVbottom">
              <div style="text-align:left; margin-left:5px; float:left;"><?= $row[3] ?></div>
              <div style="text-align:right; margin-right:5px; float:right;">Edad: <?= $row[6] ?></div>
            </div> -->
          </div>
        </a> <?php
        for($k = 0; $k < 13; $k++){
          if($k == 7){
            $this->banner_app();
          } ?>
          <a href="index.php?m=99&amp;id=">
            <div class="markvid">
              
              <div class="content_image">
                <img src="uploads/original/8acd422d5898a69d440a4cc4e097594e.jpg" width="100%" height="100%">
              </div>
              
              <div class="description">
                <div class="first_row">
                  <span class="name">Ernest</span>, 
                  <span class="age">25</span>
                </div>

                <div class="second_row">
                  <span class="time">114 min</span>, 
                  <span class="viewers">2780 viewers</span>
                </div>

                <div class="third_row">
                  <span class="country">Portugal</span>
                </div>
              </div>
            </div>
          </a>
          <?php 
        }
    }else if(@$_GET["m"] == 'support'){
  		$this->mostrar_soporte();
  	}      

    if(isset($result))          
  		$todo=mysql_query($linea,$link);
      $r2=@mysql_fetch_row($todo);
      $paginas=ceil($r2[0]/$hasta);

    if(isset($_GET["m"])){ $varm = "index.php?m=".$_GET["m"]."&p="; }else{ $varm = "index.php?p="; }

    ?>
      <div class="container" style="padding-top: 0em;">
        <ul class="pagination">
          <?php
            for($x = 1; $x <= $paginas; $x++){
              if($pag == $x)
                $go=' class="active"'; 
              else
                $go="";

              $url1 = $varm.$x;

              ?>
                <li <?= $go ?>>
                  <a href="<?= $url1 ?>"><?= $x ?></a>
                </li>
              <?php
            }
          ?>
        </ul>
      </div>

    </div>
    </div>
    <?php
  }

  function banner_app(){ ?>
    <div class="banner_app">
      <img src="img/logo_trans.png" />
      <div class="container_buttons">
        <button name="chargue_tokens" class="btn primary" id="btn_charge" type="button">RECARGAR TOKENS</button>
      </div>
    </div>
    <?php
  }
      
  function mostrar_soporte(){ ?>
    <div style="background-image:url(img/fondo_soporte.png);min-height: 400px;overflow:hidden; background-position: center; background-size: 100%">
      <h1 style="font-family:Calibri;font-size:24px;text-align: center;margin: 2rem 0"><b>Bienvenid@ a Soporte</b></h1>
      <div style="display: inline-block; width: calc(100% / 2 - 2rem); vertical-align:top">
        <div style="max-width: 100%;width:400px;padding: 1rem 2.5rem 2rem;background:white;margin:0 auto;">
          <h1 style="font-family:Calibri;font-size:16px;color:#1E1C11;">Trabaja como modelo</h1>
          <p style="color:#1E1C11;font-family:Calibri;font-size:16px;">
            Puedes participar desde casa, sólo es necesario conexión a internet y un PC con una webcam. No esperes más y accede gratis desde 
            <a style="color:#00AAEB">aquí</a>.
          </p>
        </div>
        <div style="max-width: 100%;width:400px;padding: 2rem 2.5rem 1rem;background:white;margin:1rem auto 0;">
          <p style="text-align:center;font-family:Calibri;font-size:16px;">Preguntas frecuentes</p>
          <p style="text-align:center;font-family:Calibri;font-size:16px;"> Consultas de facturación</p>
          <p style="text-align:center;font-family:Calibri;font-size:16px;">FAQs</p>
        </div>
      </div>
      <div style="display: inline-block; width: calc(100% / 2 - 2rem); vertical-align:top">
          <div style="margin:15px auto 0;width:400px;max-width: 100%;background:#EE0060;overflow:hidden;padding: 0.5rem 2rem 1rem;">
            <p style="margin:10px 0;color:white;font-size:18px;font-family:Calibri;text-align:center"><b>Preguntas generales</b></p>
            <form>
              <p style="align:center">
                <select style="width:100%;height:31px;font-size:14px;font-family:Calibri;">
                  <option>Seleccione Departamento</option>
                  <option value="soporte_tecnico">Dto.Soporte T&eacutecnico</option>
                  <option value="factura">Dto.Facturaci&oacuten</option>
                  <option value="noti">Dto.Notificaciones y Sugerencias</option>
                </select>
              </p>
              <p style="align:center">
                <input type="text" size="30" style="background:white;width:100%;height:31px;"/>
              </p>
              <p style="align:center">
                <input type="text"  size="30" style="background:white;width:100%;height:31px;"/>
              </p>
              <p style="align:centerwidth:100%;height:auto;">
                <textarea style="width: 100%;background:white;" placeholder="Descripcion" rows="5" cols="41"></textarea>
              </p>
              <p>
                <input type="submit" name="Envía" style="background:#EE0060;color:#fff;display:inline-block;font-size:1.25em;margin:20px 0 0;padding:10px 15px;border: solid thin #fff;text-align:center;text-decoration:none;"/>
              </p>
            </form>
          </div>
        </div>
    <?php
  } 

  function pagina($soporte){
    $this->cabecera();

    if($soporte==1) $this->cuerpo2();
    else $this->cuerpo();
    	
    $this->pie();

    if(isset($_SESSION["codtemp"])){}else{}   
  }
}

$pagina = new webchat("s18ea85d_fran","df6s8ref34","s18ea85d_lubricam");