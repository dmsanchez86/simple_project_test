<?php
/**
 * variable que establece la conexion con el servidor sql
 * usada por las funciones que operan con sql
 */
$conexion=new PDO("mysql:host=localhost;dbname=s18ea85d_lubricam","s18ea85d_fran","df6s8ref34");
//$conexion=new PDO("mysql:dbname=u394911770_gaya;host=mysql.hostinger.es","u394911770_admin","123456");
    function getSelectP($query,$array)
    {
        global $conexion;
        $prepara=$conexion->prepare($query);
        $prepara->execute($array);
        return $prepara->fetchAll();
    }
    function getOneSelectP($query,$array)
    {
        global $conexion;
        $prepara=$conexion->prepare($query);
        $prepara->execute($array);
        $aux=$prepara->fetch();
        return $aux[0];
    }
    /**
     * devuelve el ultimo id insertado en la conexion
     * @global PDO $conexion
     * @return type
     */
    function lastID()
    {
        global $conexion;
        return $conexion->lastInsertId();
    }
    /**
     * Recibe un string con una consulta parametizada con ? y despues
     * recibe un numero no fijo de parametros que sustituiran los ?
     * devuelve una matriz numerica y associativa de los resultados ej
     * $usuarios=getSelectP2("select * from usuarios where nombre=? and fecha>?","pepe","1993-02-23")
     * dumpeo de usuarios:
     * usuarios[X][Y] donde X es la fila (numero) donde Y es la columna ya sea por numero o por nombre de columna
     * * ej $usuarios[0]["nombre"] devuelve por ejemplo pepe $usuarios[0]["apellido"] devuelve por ejemplo perez
     * @global PDO $conexion
     * @param string $query
     * @return array
     */
    function getSelectP2($query)
    {
        global $conexion;
        $prepara=$conexion->prepare($query);
        for ($f=1,$a=func_get_args();$f<count($a);$f++)
        {
            $prepara->bindValue($f,$a[$f]);
        }
        $prepara->execute();
        return $prepara->fetchAll();
    }
    /**
     * Recibe un string con una consulta parametizada con ? y despues
     * recibe un numero no fijo de parametros que sustituiran los ?
     * devuelve una matriz associativa de los resultados ej
     * $usuarios=getSelectP2("select * from usuarios where nombre=? and fecha>?","pepe","1993-02-23")
     * dumpeo de usuarios:
     * usuarios[X][Y] donde X es la fila (numero) donde Y por nombre de columna
     * ej $usuarios[0]["nombre"] devuelve por ejemplo pepe $usuarios[0]["apellido"] devuelve por ejemplo perez
     * ej $usuarios[0][0] devuelve por ejemplo pepe $usuarios[0][1] devuelve por ejemplo perez
     * @global PDO $conexion
     * @param string $query
     * @return array
     */
    function getSelectP2Assoc($query)
    {
        global $conexion;
        $prepara=$conexion->prepare($query);
        for ($f=1,$a=func_get_args();$f<count($a);$f++)
        {
            $prepara->bindValue($f,$a[$f]);
        }
        $prepara->execute();
        return $prepara->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Recibe un string con una consulta parametizada con ? y despues
     * recibe un numero no fijo de parametros que sustituiran los ?
     * devuelve una matriz numerica de los resultados ej
     * $usuarios=getSelectP2("select * from usuarios where nombre=? and fecha>?","pepe","1993-02-23")
     * dumpeo de usuarios:
     * usuarios[X][Y] donde X es la fila (numero) donde Y es la columna por numero
     * ej $usuarios[0][0] devuelve por ejemplo pepe $usuarios[0][1] devuelve por ejemplo perez
     * @global PDO $conexion
     * @param string $query
     * @return array
     */
    function getSelectP2Numeric($query)
    {
        global $conexion;
        $prepara=$conexion->prepare($query);
        for ($f=1,$a=func_get_args();$f<count($a);$f++)
        {
            $prepara->bindValue($f,$a[$f]);
        }
        $prepara->execute();
        return $prepara->fetchAll(PDO::FETCH_NUM);
    }
    /**
     * Recibe un string con una consulta parametizada con ? y despues
     * recibe un numero no fijo de parametros que sustituiran los ?
     * devuelve un valor resultante
     * $usuario=getSelectP2("select * from usuarios where nombre=? and fecha>?","pepe","1993-02-23")
     * dumpeo de usuarios:
     * $usuarios="pepe" por que solo devuelve un valor
     * @global PDO $conexion
     * @param string $query
     * @return array
     */
    function getOneSelectP2($query)
    {
        global $conexion;
        $prepara=$conexion->prepare($query);
        for ($f=1,$a=func_get_args();$f<count($a);$f++)
        {
            $prepara->bindValue($f,$a[$f]);
        }
        $aux=$prepara->execute();
        return $aux[0];
    }
    /**
     * Crea una tabla HTML a partir de una matriz normalmente un resultado de getSelect
     * @param array $resultado matriz resultante de una consulta
     * @param string $titulo titulo que tendrá nuestra tabla
     */
    function createTableSelect($resultado,$titulo="")
    {
        if ($resultado==null)
        {
            echo "$titulo: No hay resultados";
            exit(2);
        }
        $table="<table><caption>$titulo</catpion><thead><tr>";
        //rellenamos el thead de la tabla
        foreach ($resultado[0] as $indiceCampo => $valor)
        {
            if (is_numeric($indiceCampo))
            {
                continue;
            }
            $table.="<th>$indiceCampo</th>";
        }
        $table.="</tr></thead><tbody>";
        //rellenamos el tbody
        foreach ($resultado as $fila)
        {
            $table.="<tr>";
            foreach($fila as $indiceCampo => $campo)
            {
                if (is_numeric($indiceCampo))
                {
                    continue;
                }
                $table.="<td>$campo</td>";
            }
            $table.="</tr>";
        }
        $table.="</tbody></table>";
        echo $table;
    }
    /**
     * 
     * @param string $tabla
     * Tabla en la que tenemos nuestras contraseñas.
     * @param string $campoPassword
     * campo donde tenemos nuestra contraseña cifrada con aes_encrypt(rand(),"clave").
     * @param string $campoID
     * nombre del campo identificador del usuario u objeto del que queremos comprobar el login ej: id,dni etc...
     * @param string $valorID
     * valor del campo identificador del usuario u objeto del que queremos comprobar el login ej: 1,12345678Z.
     * @param string $clave
     * valor de la clave es decir la contraseña final que el usuario ha introducido en el form o lo que proceda.
     * @return boolean (true) en caso de que el login sea correcto (false) en caso contrario.
     */
    function loguea($tabla,$campoPassword,$campoID,$valorID,$clave)
    {
        $valor=getOneSelectP2("select aes_decrypt($campoPassword,?) from $tabla WHERE $campoID=?",$clave,$valorID);
        return ($valor==true)?true:false;
    }
    /**
     * a partir de una matriz (normalmente el resultado de una consulta usando getSelect)
     * crea un documento XML 
     * @param array $resultado matriz de la cual obtendremos los datos para nuestro fichero xml
     * @param string $raizNombre nombre del nodo raiz de nuestro documento xml
     * @param string $elementosNombre nombre de cada elemento hijo del raiz
     * @param boolean $id en caso de ser true los campos con nombre id pasaran a ser atributo en lugar de Nodos
     * @return \DomDocument
     */
    function resultadoXML($resultado,$raizNombre,$elementosNombre,$id=false)
    {
        $xml=new DomDocument("1.0","UTF-8");
        $raiz=$xml->createElement($raizNombre);
        $xml->appendChild($raiz);
        
        $elementos=array();
        $c=0;
        foreach ($resultado[0] as $indiceCampo => $valor)
        {
            if (is_numeric($indiceCampo))
            {
                continue;
            }
            $elementos[$c]=$indiceCampo;
            $c++;
        }
        for ($f=0,$cc=0;$f<count($resultado);$f++,$cc=0)
        {
            $elementoNuevo=$xml->createElement($elementosNombre);
            foreach ($resultado[$f] as $indice => $valor)
            {
                if (!is_numeric($indice))
                {
                    continue;
                }
                if ($id==true&&$indice=="id")
                {
                    $elementoNuevo->setAttribute("id", $valor);
                    $cc++;
                    continue;
                }
                $elementoNuevoApendice=$xml->createElement($elementos[$cc]);
                $elementoNuevoApendice->appendChild($xml->createTextNode($valor));
                $elementoNuevo->appendChild($elementoNuevoApendice);
                $cc++;
            }
            $raiz->appendChild($elementoNuevo);
        }
        return $xml;
    }
    /**
     * Crea una tabla incluyendo datos a partir de un objeto DOM (xml)
     * @param DomDocument $xml objeto a Dom apartir del cual se creará la tabla
     * @param string $basedatos base de datos donde crear la tabla
     */
    function createTablesXML($xml,$basedatos)
    {
        echo "create database if not exists $basedatos";
        getSelectP2("create database if not exists $basedatos");
        getSelectP2("use $basedatos");
        $raiz=$xml->childNodes->item(0);
        $nodo=$raiz->childNodes->item(0);
        echo "<br/>";
        $insercion="create table if not exists $raiz->nodeName (";
        for ($f=0;$f<$nodo->childNodes->length;$f++)
        {
            $nodo2=$nodo->childNodes->item($f);
            $insercion.=$nodo2->nodeName;
            //falta si es fecha se codificara mas adelante
            
            if (boolval($nodo2->nodeValue)!=$nodo2->nodeValue)
            {
                $insercion.=" boolean";
            }
            else if (intval($nodo2->nodeValue)!=$nodo2->nodeValue)
            {
                $insercion.=" numeric(65,30)";
            }
            else if (is_numeric($nodo2->nodeValue))
            {
                $insercion.=" int";
            }
            else
            {
                $insercion.=" varchar(1000)";
            }
            if ($nodo2->nodeName=="id")
            {
                $insercion.=" primary key";
            }
            $insercion.=($f==$nodo->childNodes->length-1)?"":",";
        }
        $insercion.=")";
        echo $insercion;
        getSelectP2($insercion);
        for ($f=0;$f<$raiz->childNodes->length;$f++)
        {
            $insert="insert into $raiz->nodeName values (";
            $nodo=$raiz->childNodes->item($f);
            $campos=array();
            for ($h=0;$h<$nodo->childNodes->length;$h++)
            {
                $nodo2=$nodo->childNodes->item($h);
                $insert.=($h==$nodo->childNodes->length-1)?"?":"?".",";
                $campos[$h]=$nodo2->nodeValue;
            }
            $insert.=")";
            echo "<br/>$insert";
            getSelectP($insert,$campos);
        }
    }
    /**
     * Crea un formulario a partir de una tabla
     * @param string $tabla nombre de la tabla para hacer formulario
     * @param string $action nombre del fichero a ejecutar cuando se envia el formulario
     * @param string $method metodo (POST,GET) para el envio de datos
     * @param array $campos campos que queremos excluir o solo incluir dependiendo de $quita
     * @param boolean $quita (true o false) true para que $campos excluya, false para solo incluir
     */
    function creaFormularioBD($tabla,$action,$method="POST",$campos,$quita=true)
    {
        $resultado=getSelectP2("desc $tabla");
        $formularioInsert="<form method=\"$method\" action=\"$action\">";
        for ($f=0,$h=0;$f<count($resultado);$f++)
        {
            if ($quita==true&&in_array($resultado[$f]["Field"],$campos)==true)
            {
                continue;
            }
            else if ($quita==false&&in_array($resultado[$f]["Field"],$campos)==true)
            {
                $formularioInsert.="<input placeholder=\"{$resultado[$f]["Field"]}\" type=\"text\" "
                . "name=\"{$resultado[$f]["Field"]}\" id=\"{$resultado[$f]["Field"]}\"/><br/>";
                continue;
            }
            if ($quita!=false)
            {
            $formularioInsert.="<input placeholder=\"{$resultado[$f]["Field"]}\" type=\"text\" name=\"{$resultado[$f]["Field"]}\" id=\"{$resultado[$f]["Field"]}\"/><br/>";
            }
        }
        $formularioInsert.="<input type=\"submit\" value=\"Enviar\" name=\"$tabla\" id=\"$tabla\"/></form>";
        echo $formularioInsert;
    }
    //$conexion->query("use test");
    //creaFormularioBD("usuarios", "BD.php", "POST", array("id"),true);
    /*header("Content-type: text/xml");
    $conexion->query("use test");
    $xml=resultadoXML(getSelectP2("select * from equipos"),"equipos","equipo",true);
    echo $xml->saveXML();*/
    //createTableSelect(getSelectP2("select nsombre from usuarios"),"tabla1");
    //ejemplo de en una sola linea comprobar si un login es correcto
    //echo (loguea("login", "password", "id", 1, "ricardo")==true)?"Login Correcto":"Login Incorrecto";