<?php require_once '../Controler/Perfil.php';
require_once '../Controler/lib/Utilidades.php';
checkAccess("?ruta=perfil.php");?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../data/bootstrap.min.js"></script>
        <script src="../data/holder.js"></script>
        <script src="../assets/fancybox/jquery.easing-1.3.pack.js"></script>
        <script src="../assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <script src="../assets/webcam/webcam.js"></script>
        <script src="../assets/js/script.js"></script>
        <script src="../assets/js/perfil.js"></script>
        <script src="../assets/js/basico.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../assets/css/styles.css" />
        <link rel="stylesheet" type="text/css" href="../assets/fancybox/jquery.fancybox-1.3.4.css" />
        <link href="../data/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../data/menu.css" type="text/css" media="screen" />
        <link href="../data/bootstrap.css" rel="stylesheet">
        <!-- chosen -->
        <link href="../assets/lib/chosen_v1.4.2/chosen.css" type="text/css" rel="stylesheet"/>
        <script src="../assets/lib/chosen_v1.4.2/chosen.jquery.js" type="text/javascript"></script>
        <!-- //chosen// -->
        <link href="../assets/css/basico.css" rel="stylesheet">
        <link href="../assets/css/perfil.css" rel="stylesheet">
        
    </head>
    <body>
        <?php include "header.php"; ?>
        <!-- Navegacion del perfil-->
        <ul class="nav nav-tabs" style="float: none">
            <li id="biografiaNav" role="presentation" class="active navegacion-boton"><a href="#mi-biografia">Mi biografía</a></li>
            <li id="configuracionNav" role="presentation" class="navegacion-boton"><a href="#configuracion">Configuración</a></li>
            <li id="tokensNav" role="presentation" class="navegacion-boton"><a href="#tokens">Mis Tokens</a></li>
            <li id="favoritosNav" role="presentation" class="navegacion-boton"><a href="#favoritos">Mis favoritos</a></li>
            <li id="galeriaNav" role="presentation" class="navegacion-boton"><a href="#favoritos">Mi Galeria</a></li>
            <li id="eventosNav" role="presentation" class="navegacion-boton"><a href="#eventos">Eventos</a></li>
            <li id="ayudaNav" role="presentation" class="navegacion-boton"><a href="#ayuda">Ayuda</a></li>
        </ul>
        <!--Configuracion-->
        <section id="configuracion" class="navegacion oculto">
            <div class="container">
                <form method="post" action="Perfil.php" class="form-horizontal" role="form">
                    <h2>Configuracion de mi Show</h2>
                <h6>Bloquear Usuarios por Pais:</h6>
                <div class="form-group">
                    <div class="col-lg-2">
                        <select class="paises-bloqueables" multiple="multiple">
                            <?php
                            /**
                             * Falta que aqui se omitan los paises que previamente estaban bloqueados usando algun in_array 
                             */
                                foreach ($paises as $pais)
                                {
                                    echo "<option class=\"pais-bloqueable\" value=\"{$pais["id"]}\">{$pais["pais_es"]}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select name="paises-bloqueados[]" class="paises-bloqueados" multiple="multiple">
                            <option disabled="disabled">Paises Bloqueados</option>
                            <?php
                                foreach ($paisesBloqueados as $pais)
                                {
                                    echo "<option class=\"pais-bloqueado\" selected=\"selected\" value=\"{$pais["id"]}\">{$pais["pais_es"]}</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                  <!--<div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <input name="configurar" type="submit" class="btn btn-default" value="Actualizar"/>
                    </div>
                  </div>-->
                  <input type="submit" name="configurar" value="Actualizar" class="btn btn-primary btn-lg">
            </form>
                </div>
        </section>
        <!--Tokens-->
        <section id="tokens" class="navegacion oculto">
            Tokens
        </section>
        <!--Favoritos-->
        <section id="favoritos" class="navegacion oculto">
            Favoritos
        </section>
        <!-- Mi galeria -->
        <section id="mi-galeria" class="navegacion oculto">
            <form action="Perfil.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                <div class="form-group">
                  <label for="ejemplo_email_3" class="col-lg-2 control-label">Imagen</label>
                  <div class="col-lg-4">
                    <input name="imagen" type="file" id="imagen-galeria" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="ejemplo_email_3" class="col-lg-2 control-label">Titulo</label>
                  <div class="col-lg-4">
                    <input name="tituloImagen" type="text" class="form-control" id="ejemplo_email_3"
                           placeholder="Titulo">
                  </div>
                </div>
                <div class="form-group">
                  <label for="ejemplo_password_3" class="col-lg-2 control-label">Descripcion</label>
                  <div class="col-lg-4">
                      <textarea name="descripcionImagen" class="form-control" id="ejemplo_password_3" placeholder="Descripcion"></textarea>
                  </div>
                </div>
                <div class="form-group">
                    <label for="ejemplo_password_3" class="col-lg-2 control-label">Precio</label>
                    <div class="col-lg-4">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <input id="precio-box" type="checkbox" aria-label="...">
                        </span>
                        <input name="precioImagen" id="precio-input" type="text" class="form-control" aria-label="...">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div>
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-4">
                    <input name="subir-foto" type="submit" class="btn btn-default" value="Subir Foto" />
                  </div>
                </div>
            </form>
            <div>
                <h3>Mi Album</h3>
                <div>
                    
                </div>
            </div>
        </section>
        <!--Eventos-->
        <section id="eventos" class="navegacion oculto">
            Eventos
        </section>
        <!--Ayuda-->
        <section id="ayuda" class="navegacion oculto">
            <ul class="nav nav-tabs" style="float: none">
                <li id="queEsNav" role="presentation" class="active navegacion-boton-ayuda"><a href="#Que-es-lubricam">¿Qué es LubriCam?</a></li>
                <li id="comoFuncionaNav" role="presentation" class="navegacion-boton-ayuda"><a href="#como-funciona">¿Cómo funciona?</a></li>
                <li id="serModeloNav" role="presentation" class="navegacion-boton-ayuda"><a href="#ser-modelo">Ser Modelo</a></li>
                <li id="comoRetransmitirNav" role="presentation" class="navegacion-boton-ayuda"><a href="#como-retransmitirte">¿Cómo retransmitirte?</a></li>
                <li id="FAQNav" role="presentation" class="navegacion-boton-ayuda"><a href="#FAQs">FAQs</a></li>
            </ul>
            ayuda
        </section>
<!-- mi biografia -->
<section id="biografia" class="navegacion">
<div class="cuerpo">
    <div align="center">
    <div class="marfor1">
    <div align="left">
    <h1 style="margin: 5px; color:#c61863; font-size:1.9em;">Edita tu perfil</h1>
    <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
    <button id="iniciar-cam">Establecer Foto Perfil</button>
    <button id="snap">Tomar Foto</button>
    <div class="cam">
        <video class="video" id="video" width="350" height="300" autoplay></video>
        <canvas class="foto" id="canvas" width="350" height="300"></canvas>
    </div>
    <br class="limpia"/>
    <form class="limpia" action="Perfil.php" method="post" name="formactu">        
      <div class="form-group">
        <label>Fecha de nacimiento ( Ejemplo: 1 / 1 / 1980 )</label>
        <br/>
    <select name='dia' style='width:75px; display: inline-block; margin-right:25px;' class='form-control' required>
        <option value=''>Día</option>
        <?php 
            for ($f=1;$f<32;$f++)
            {
                echo "<option ".(($f==$fecha[2])?'selected="selected"':"")." value='$f'>$f</option>";
            }
        ?>
    </select>
    <select name='mes' style='width:75px; display: inline-block; margin-right:25px;' class='form-control' required>
        <option value=''>Mes</option>
        <?php 
            for ($f=1;$f<13;$f++)
            {
                echo "<option ".(($f==$fecha[1])?'selected="selected"':"")." value='$f'>$f</option>";
            }
        ?>
    </select>
    <select name='ano' style='width:125px; display: inline-block;' class='form-control' required>
        <option value=''>Año</option>
        <?php 
            for ($f=1910;$f<((int)date("Y")-18);$f++)
            {
                echo "<option ".(($f==$fecha[0])?'selected="selected"':"")." value='$f'>$f</option>";
            }
        ?>
    </select>
    <br /><font style="color:#c0c0c0; font-size:12px;">* La fecha de nacimiento aquí indicada debe coincidir con tus datos de compra o cobro de tokens para evitar errores de verificación de usuario.</font>
      </div>
      <div class="form-group">
        <label>Nombre</label>
        <input type="text" class="form-control" id="alias" name="nombre" value="<?php echo $usuario["nombre"]; ?>"
               placeholder="Introduce tu nombre" required>
      </div>
      <div class="form-group">
        <label>Idioma natal:</label>
        <select class="chooseable" name="idioma">
            <?php
            foreach ($idiomas as $idioma)
            {
                echo "<option ".(($idioma["id"]==$usuario["id_idioma"])?'selected="selected"':"")." value=\"{$idioma["id"]}\">{$idioma["descripcion"]}</option>";
            }?>
        </select>
      </div>
      <div class="form-group">
        <label>País:</label>
        <select class="chooseable" name="pais">
            <?php
            foreach ($paises as $pais)
            {
                echo "<option ".(($pais["id"]==$usuario["id_pais"])?'selected="selected"':"")." value=\"{$pais["id"]}\">{$pais["pais_es"]}</option>";
            }
            ?>
        </select>
      </div>
      <div class="form-group">
        <label>Localidad:</label>
        <input type="text" class="form-control" id="localidad" name="localidad" value="<?php echo $usuario["localidad"]; ?>"
               placeholder="Introduce tu localidad">
      </div>
      <div class="form-group">
        <label>Tatoos, Piercing?:</label>
        <textarea class="form-control" name="detalles"><?php echo $usuario["detalles"]; ?></textarea>
      </div>  
      <div class="form-group">
        <label>Acerca de mi:</label>
        <textarea class="form-control" name="descripcion"><?php echo $usuario["descripcion"] ?></textarea>
      </div>
    <br /><br />
    <input type="submit" name="enviar" value="Actualizar" class="btn btn-primary btn-lg">
    </form>
    </div>
    </div>
    <div class="marfor2">
    <div align="left">
    <h1 style="margin: 5px; color:#c61863; font-size:1.9em;">As&iacute; te ver&aacute;n</h1>
    <hr class="featurette-divider" style="margin:5px 0 20px 0; border-color:#D0D0D0;">
    <div id="fotoPerfilActual">
        <img class="foto-perfil" id="imagenPerfil" src="<?php echo GALERIAVISTA."/$nick/".$fotoPerfil["url"]; ?>">
    </div>
         <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Alias:</p></div>
         </div>
         <div class="columnados">
              <div class="filauno"><?php echo $nick; ?></div>
         </div>
    <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
         <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Edad:</p></div>
         </div>
         <div class="columnados">
              <div class="filauno"><?php echo $edad; ?></div>
         </div>
    <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
         <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Idioma natal:</p></div>
         </div>
         <div class="columnados">
              <div class="filauno"><?php echo $usuarioIdioma["descripcion"]; ?></div>
         </div>
         <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
         <div class="columnauno">
              <div class="filauno"><p class="textfiluno">País:</p></div>
         </div>
         <div class="columnados">
              <div class="filauno"><?php echo $usuarioPais["pais_es"]; ?></div>
         </div>
         <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
         <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Localidad:</p></div>
         </div>
         <div class="columnados">
              <div class="filauno"><?php echo $usuario["localidad"] ?></div>
         </div>
         <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
         <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Tatoos, Piercing?:</p></div>
         </div>
         <div class="columnados">
              <div class="filauno"><?php echo $usuario["detalles"] ?></div>
         </div>
         <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
         <div class="columnauno">
              <div class="filauno"><p class="textfiluno">Descripción:</p></div>
         </div>
         <div class="columnados">
              <div class="filauno"><?php echo $usuario["descripcion"] ?></div>
         </div>
    <hr class="featurette-divider" style="margin:5px 0 10px 0; border-color:#D0D0D0;">
    </div></div></div></div>
</section>
    <?php include 'footer.php'; ?>
    </body>
</html>
