<?php
require_once 'lib/BD.php';
require_once 'lib/Aleatorio.php';
require_once 'lib/Utilidades.php';


const NULO=false;
const NONULO=true;
const DESACTIVO=0;
const ACTIVO=1;
$datosOK=true;

    function verificaDato($nombreDato,$valorDato,$longitudMinima,$longitudMaxima,$null=NULO,$patron="",$mensajePatron="")
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
            if ($valorDato!=$_POST["clave2"])
            {
                $errores[$nombreDato].="<div>Las contraseñas deben ser iguales</div>";
                $datosOK=false;
            }
        }
    }
    function verificaDatosUsuario()
    {
        global $datosOK;
        verificaDato("nick", $_POST["usuario"], 0, 250,NONULO,"/^([a-zA-Z0-9])+([a-zA-Z0-9_-])*$/","El nick no debe contener caracteres especiales ni espacios");
        verificaDato("password", $_POST["clave"], 0, 30,NONULO);
        verificaDato("email", $_POST["correo"], 0,255,NONULO,"/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/","Debes introducir un email valido");
        //verificaDato("fecha_nacimiento",$_POST["fecha_nacimiento"],0,255,NONULO,"/^[0-9]{4}\-(0[1-9]|1[0-2])\-(0[1-9]|[1-2][0-9]|3[0-1])$/","Debes introducir una fecha valida");
        //muestraErrores();
        return $datosOK;
    }
    function insertaUsuario()
    {
        //echo $_POST["usuario"],$_POST["correo"],$_POST["clave"];
        $semilla=aleatorio(200);
        $codigoActivacion=aleatorio(200);
        echo $_POST["clave"];
        getSelectP2("insert into lubri_usuarios (nick,semilla,password,activo,codigo_activacion,correo,fecha_registro) values (?,?,AES_ENCRYPT(?,sha1(?)),?,?,?,?)",
                    $_POST["usuario"],$semilla,$semilla,$_POST["clave"],ACTIVO,$codigoActivacion,$_POST["correo"],date("Y-m-d H:i:s"));
    }
    function creaDirectorioUsuario()
    {
        mkdir(GALERIACONTROLER."/".$_SESSION["nick"], 0777);
    }
    function nuevoUsuario()
    {
        if (verificaDatosUsuario())
        {
            insertaUsuario();
            session_start();
            $_SESSION["nick"]=$_POST["usuario"];
            creaDirectorioUsuario();
            header("Location: http://lubricam.com/Vista/Perfil.php");
            die();
        }
        else
            echo "vas mal";
    }
    $mensaje="";
    function loguear()
    {
        global $mensaje;
        $semilla = getSelectP2Numeric('select semilla from lubri_usuarios where nick=?',$_POST["usuariologin"]);
        $login   = getSelectP2Numeric('select AES_DECRYPT(password,SHA1(?)) as semilla from lubri_usuarios where nick=?',$_POST["clavelogin"],$_POST["usuariologin"]);
        if ($login[0][0]!=""&&$semilla[0][0]!=""&&$login[0][0]==$semilla[0][0])
        {
            $mensaje="bienvenido";
            session_start();
            $_SESSION["nick"]=$_POST["usuariologin"];
            header("Location: http://lubricam.com/Vista/Perfil.php");
        }
        else
        {
            $mensaje="Nombre de Usuario o Password Incorrecto";
        }
    }
    //main
    if (isset($_POST["registro"]))
    {
        nuevoUsuario();
    }
    else if (isset($_POST["acceso"]))
    {
        loguear();
    }
    //endmain