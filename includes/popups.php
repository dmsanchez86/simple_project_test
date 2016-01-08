<!-- Popup Inicio -->
<div  id="start" class="start" style="padding:0px;">
  <div class="content_box">
    <div class="conditions">
      <h1>Bienveni@ a Lubri<b>C</b>am</h1>
      <div class="container_buttons">
        <button class="btn" id="btn_go_out" type="button" >SALIR</button>
        <button class="btn" id="btn_enter" type="button" >ENTRAR</button>
      </div>
      <div class="accept_terms">
        <input type="checkbox" id="accept_terms" class="" />
        <label for="">
          He leído y acepto los <b>Términos y Condiciones</b> de este sitio, declarando ser mayor de edad
        </label>
      </div>
    </div>
    <div class="container_img">
      <img src="img/seguridad.png"></img>
    </div>
  </div>
</div>

<!-- Popup Inicio de Sesion -->
<div  id="login" class="login" style="padding:0px;">
  <div class="content_box">
    <span class="close_pop">X</span>
    <form id="login_form" method="post" action="index.php?entra=1" style="background-size: 100%; background-repeat: no-repeat; width: 100%;padding: 3rem">
      <h1>Bienveni@ a Lubri<b>C</b>am</h1>
      <p style="margin-left: auto;margin-right: auto;"> 
        <input type="text" id="login_name" name="login_name" style="width:100%;height:41px;border:D9D9D9;text-align:center;" placeholder="Alias" size="30" />
      </p>
      <p style="margin-left: auto;margin-right: auto;">
        <input type="password" id="login_pass" name="login_pass" style="width:100%;height:41px;border:D9D9D9;text-align:center;" placeholder="Contrase&ntilde;a" size="30" />
        <!-- <img src="img/ojo.png"/> -->
      </p>
      <div class="container_buttons">
        <button class="btn primary" id="btn_login" type="submit" >ENTRAR</button>
      </div>
      <div class="accept_remember">
        <input type="checkbox" id="accept_remember" class="" />
        <label for="accept_remember">
          Recordame
        </label>
        <a href="#forgot_password">¿Has olvidado la contraseña?</a>
      </div>
      <p style="text-align: center;">
        <span>¿Todavia no eres usuario? <a href="#register" style="font-family:Calibri;">Registrate!</a></span>
      </p>
    </form>
  <div class="container_img">
    <img src="img/seguridad.png"></img>
  </div>
  </div>
</div>

<!-- Popup Registro -->
<div  id="register" class="register" style="padding:0px;">
  <div class="content_box">
    <span class="close_pop">X</span>
    <form id="registro_form" method="post" action="inicio.php?a=1" style="padding: 3rem">        
      <p id="login_error" style="color:#81BEF7;margin-left: auto;margin-right: auto;">
        Elige un alias y una contrase&ntilde;a faciles de recordar
      </p>
      <p style="margin-left: auto;margin-right: auto;"> 
        <input type="text" id="register_name" name="usuario" style="width:100%;height:41px;border:D9D9D9;text-align:center;" placeholder="Alias" size="30" />
      </p>
      <p style="margin-left: auto;margin-right: auto;">
        <input type="password" id="user" name="clave" style="width:100%;height:41px;border:D9D9D9;text-align:center;" placeholder="Contraseña" size="30" />
      </p>
      <p style="margin-left: auto;margin-right: auto;"> 
        <input type="text" id="email" name="correo" style="width:100%;height:41px;border:D9D9D9;text-align:center;" placeholder="Email" size="30" />
      </p>
      <p>
        <img src="data/captcha.php" width="100" height="30" vspace="3" border="1" style="height:42px;border: darkgrey solid thin;width: 140px">
        <input type="text" name="numero_seg" class="CajaStyleCod" onpaste="return false" tabindex="6" autocomplete="off" style="height:41px;border:D9D9D9;text-align:center;" required>  
      </p>
      <div class="accept_terms">
        <input type="checkbox" id="accept_terms_register" class="" />
        <label for="">
          He leído y acepto los <b>Términos y Condiciones</b> de este sitio, declarando ser mayor de edad
        </label>
      </div>
      <div class="container_buttons">
        <button name="registro" class="btn primary" id="btn_register" type="submit">REGISTRARSE</button>
      </div>
      <p style="text-align:center;margin-top: 1rem">
        <span>
          <a href="#login"style="font-family:Calibri (Body),11,bold,#3ACBFF">¿Ya estas registrado? Entra!</a>
        </span>
      </p>
    </form>
    <div class="container_img">
      <img src="img/seguridad.png"></img>
    </div>
  </div>
</div>

<!-- Popup Olvido de Contraseña -->
<div  id="forget_password" class="forget_password" style="padding:0px;">
  <div class="content_box">
    <span class="close_pop">X</span>
    <form id="forget_password_form" method="post" action="index.php?entra=1" style="padding: 3rem">        
      <p id="login_error" style="color:#323232;margin-left: auto;margin-right: auto;">
        ¡Hola!<br>
        Introduce  la dirección de correo registrada, <br>
        te enviaremos los nuevos datos a la cuenta.
      </p>
      <p style="margin-left: auto;margin-right: auto;"> 
        <input type="email" id="forget_email" name="forget_email" style="width:100%;height:41px;border:D9D9D9;text-align:center;" placeholder="Correo Electronico" size="30" />
      </p>
      <div class="container_buttons">
        <button class="btn primary" id="btn_forget_password" type="submit" >ENVIA</button>
      </div>
      <p style="text-align: center;margin: 4rem 0 2rem 0rem">
        <span><a href="#register" style="font-family:Calibri;">¿Todavia no eres usuario? Registrate!</a></span>
      </p>
      <p style="text-align: center;margin: 0;">
        <span><a href="#back_login" style="font-family:Calibri;color: #323232;"><< Volver atrás</a></span>
      </p>
    </form>
    <div class="container_img">
      <img src="img/seguridad.png"></img>
    </div>
  </div>
</div>

<!-- Popup de los Términos y Condiciones -->
<div  id="terms" class="terms" style="padding:0px;">
  <div class="content_box">
    <span class="close_pop">X</span>
    <div class="content_terms">
      <h2>Términos y Condiciones</h2>
      <div class="text">
        <p>Este sitio web contiene información, enlaces, imágenes y vídeos de material sexualmente explícito. No continúe si: (i) no tiene por lo menos 18 años de edad o mayores de edad en su jurisdicción en la que usted puede ver el material sexualmente explícito, (ii) dicho material le ofende, o (iii) de ver el material sexualmente explícito no es legal en su comunidad o país donde  elige para visualizar.
        Al optar por entrar en este sitio web que está afirmando bajo juramento y pena de perjurio de conformidad con el Título 28 USC § 1746 y otros estatutos y leyes que todas las siguientes declaraciones son verdaderas y correctas aplicables:</p>
        <ul>
          <li>He alcanzado la mayoría de edad en mi jurisdicción;</li>
          <li>El material sexualmente explícito que voy a ver es para mí uso personal y no voy a exponer a los menores a dicho material;</li>
          <li>Deseo recibir / ver material sexualmente explícito;</li>
          <li>Creo que como adulto es mi derecho constitucional inalienable a recibir / ver material sexualmente explícito;</li>
          <li>Creo que los actos sexuales entre adultos que consienten no son ni ofensivos ni obscenos;</li>
          <li>La visualización, lectura y descarga de material sexualmente explícito no viola los estándares de cualquier comunidad, pueblo, ciudad, estado o país donde lo visualizaré, leeré y / o descargue los materiales sexualmente explícitos;</li>
          <li>Yo soy el único responsable de cualquier revelación o ramificaciones legales de ver, leer o descargar cualquier material que aparezca en este sitio. También estoy de acuerdo que ni este sitio ni sus filiales serán responsables por cualquier ramificación legal que surjan de cualquier entrada fraudulenta en o el uso de este sitio web;</li>
          <li>Entiendo que mi uso de este sitio web se rige por Términos del sitio web que he revisado y aceptado, y yo estoy de acuerdo en estar obligado por estos Términos.</li>
          <li>Estoy de acuerdo que al entrar en este sitio web, me estoy sometiendo a mí mismo, y cualquier entidad en la que tengo algún interés legal o equitativo, a la jurisdicción Europea, si surgiera cualquier disputa en cualquier momento entre este sitio web, yo y / o tal entidad;</li>
          <li>Esta página de advertencia constituye un acuerdo legalmente vinculante entre yo, este sitio web y / o cualquier negocio en el que tengo algún interés legal o equitativo. Si alguna disposición de este Acuerdo se encuentra que es inaplicable, el resto se hará cumplir la medida de lo posible y la disposición inaplicable se considerará modificada a la limitada medida necesaria para permitir su aplicación de manera que representa más de cerca las intenciones expresadas en el presente documento;</li>
          <li>Todos los artistas en este sitio son mayores de 18 años, han consentido ser fotografiado y / o filmado, creen que es su derecho a participar en actos sexuales consensuales para el entretenimiento y la educación de otros adultos y creo que es mi derecho como adulto para verlos hacer lo que hacen los adultos;</li>
          <li>Los vídeos y las imágenes de este sitio están destinados a ser utilizados por adultos responsables como ayudas sexuales, para proporcionar educación sexual y para proporcionar entretenimiento sexual;</li>
          <li>Entiendo que proveer una declaración falsa bajo pena de perjurio es un delito penal; y</li>
          <li>Estoy de acuerdo en que este acuerdo se rige por la Ley de Firmas Electrónicas en el Comercio Global y Nacional (comúnmente conocido como el "E-Sign Act"), 15 USC § 7000, et seq., Y por la elección de hacer clic en "Acepto." indica mi aceptación a estar obligado por los términos de este acuerdo, yo afirmativamente adopto la línea de firma abajo como mi firma y la manifestación de mi consentimiento en obligarse por los términos de este acuerdo.</li>
        </ul>

        <p>En ésta web se coopera activamente con la aplicación de la ley y supuestos casos de sospecha de uso ilegal del servicio, en especial en el uso ilegal del servicio por menores de edad.</p>
      </div>
      <div class="container_buttons">
        <button class="btn blue" id="btn_read" type="button">LEIDO</button>
      </div>
    </div>
  </div>
</div>

<!-- Popup Temporizador 1 -->
<div  id="temp1" class="temp one" style="padding:0px;">
  <div class="content_box">
  <span class="close_pop">X</span>
    <div class="conditions">
      <h4>Registrate Gratis</h4>
      <ul>
        <li>Puedes añadir modelos a tu lista de favoritos</li>
        <li>Personalizar tu perfil Lubri<b style="color: #FF3232; font-weight: normal">C</b>am</li>
        <li>Ver las galerías personales de modelos amateur</li>
        <li>Retransmitirte y ganar dinero</li>
        <li>Chatea con modelos</li>
      </ul>
      <div class="container_buttons right">
        <button class="btn primary" id="btn_register_alias" type="button" >TU ALIAS</button>
      </div>
    </div>
  </div>
</div>

<!-- Popup Temporizador 2 -->
<div  id="temp2" class="temp two" style="padding:0px;">
  <div class="content_box">
  <span class="close_pop">X</span>
    <div class="conditions">
      <h4>Recarga un minimo de Tokens y <br>obtén todos los servicios de Lubri<b style="color: #FF3232; font-weight: normal">C</b>am</h4>
      <ul>
        <li>Seguir a modelos</li>
        <li>Revelar su país de contacto</li>
        <li>Chatear con tus modelos favoritas</li>
        <li>Pantalla completa de la sala</li>
        <li>Acceder a salas en privado</li>
        <li>Ser un moderador de chat</li>
        <li>Participar en eventos con modelos</li>
        <li>Y mucho más</li>
      </ul>
      <div class="container_buttons right">
        <button class="btn primary" id="btn_recharge_tokens" type="button" >RECARGA TOKENS</button>
      </div>
    </div>
  </div>
</div>

<!-- Popup Temporizador 2 -->
<div  id="log_in" class="temp two log" style="padding:0px;">
  <div class="content_box">
  <span class="close_pop">X</span>
    <div class="conditions">
      <h1>info Lubri<b>C</b>am</h1>
      <p>Cada vez que accedas, Lubricam te<br>obsequiara con <b style="font-weight: normal">15 Tokens gratis</b> cada 24h</p>
      <ul>
        <li>Podrás disfrutar de todos los servicios</li>
        <li>Estos Tokens no son acumulables</li>
        <li>Tampoco se puede regalra o cobrar</li>
        <li>Los verás en tu monedero virtual</li>
        <li>Puedes empezar ya a disfrutarlos</li>
      </ul>
      <div class="container_buttons right">
        <button class="btn primary" id="btn_thanks" type="button" >Ok, gracias</button>
      </div>
    </div>
    <fieldset>
      <em>Aviso: </em> 
      <b>Dto. Seguridad y estabilidad</b><br>
      <b>
        El intento de fraude o similar sera informado <br> 
        de inmediato a las autoridades competentes <br>
        con los datos aquí procesados por su IP, como <br>
        indica en <a href="#terms">términos y condiciones</a> de LubriCam. 
      </b>
    </fieldset>
  </div>
</div>