<?
session_start();


if(isset($id)){}elseif(isset($_GET["id"])){ $id = $_GET["id"]; }else{ $id = false; }

function sacnomaud($id)
{
            $link = mysql_connect("localhost","s18ea85d_fran","df6s8ref34");
            mysql_select_db("s18ea85d_lubricam", $link);
            $result = mysql_query("SELECT * FROM registro WHERE id = '$id'", $link);
                    if (@$row = mysql_fetch_array($result)){
                    return $row[1];
                    } else { return false; }
            mysql_close($link);
}


function saccoraud($id)
{
            $link = mysql_connect("localhost","s18ea85d_fran","df6s8ref34");
            mysql_select_db("s18ea85d_lubricam", $link);
            $result = mysql_query("SELECT * FROM registro WHERE id = '$id'", $link);
                    if (@$row = mysql_fetch_array($result)){
                    return $row[2];
                    } else { return false; }
            mysql_close($link);
}

function sacacorre()
{
            $link = mysql_connect("localhost","s18ea85d_fran","df6s8ref34");
            mysql_select_db("s18ea85d_lubricam", $link);
            $idusu = $_SESSION["numus"];
            $result = mysql_query("SELECT * FROM registro WHERE id = '$idusu'", $link);
                    if (@$row = mysql_fetch_array($result)){
                    return $row[2];
                    } else { return false; }
            mysql_close($link);
}



function vertokusu($dato)
{
            $link = mysql_connect("localhost","s18ea85d_fran","df6s8ref34");
            mysql_select_db("s18ea85d_lubricam", $link);

            $corustok = sacacorre();

            $result = mysql_query("SELECT * FROM creditos WHERE correo = '$corustok'", $link);
                    if (@$row = mysql_fetch_array($result)){
                    if( $row[1] < $dato ){}else{}
                    
                    return $row[2];
                    } else { return false; }
            mysql_close($link);
}



//$id = $_GET["id"];


if(isset($id)){


$name = $_SESSION['name'];
$nomaud = sacnomaud($id);
$corusu = sacacorre();
$coraudi = saccoraud($id);


    
if(isset($_POST["userdona"])){

$text = $_POST['userdona'];







            $link = mysql_connect("localhost","s18ea85d_fran","df6s8ref34");
            mysql_select_db("s18ea85d_lubricam", $link);
            
            
            
            $contok = mysql_query("SELECT * FROM creditos WHERE correo = '$corusu'", $link);
                    if (@$row = mysql_fetch_array($contok)){
                    if( $row[1] < $text ){


                    }else{



    $fp = fopen("$nomaud.html", 'a');
    fwrite($fp, "<div class='msgdona'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: Te ha donado: ".stripslashes(htmlspecialchars($text))." Tokens <img src='img/coins.png' style='width:auto; height:auto; display: inline-block; margin:5px;'><br></div>");
    fclose($fp);

            
            

            $result = mysql_query("SELECT * FROM creditos WHERE correo = '$corusu'", $link);
                    if (@$row = mysql_fetch_array($result)){
                    $calcu = $row[1] - $text;
                    //Descontamos lo donado del usuario.
                    mysql_query("UPDATE creditos SET fichas = '$calcu' WHERE correo = '$corusu'");
                    }else{echo "<h1 style='text-color:red;'>ERROR!</h1>";}
                    

            $resultdos = mysql_query("SELECT * FROM creditos WHERE correo = '$coraudi'", $link);
                    if (@$row = mysql_fetch_array($resultdos)){
                    $calcudos = $row[1] + $text;
                    //Descontamos lo donado del usuario.
                    mysql_query("UPDATE creditos SET fichas = '$calcudos' WHERE correo = '$coraudi'");
                    }else{echo "<h1 style='text-color:red;'>ERROR!</h1>";}



                    }
                    } else { echo "<h1 style='text-color:red;'>ERROR!</h1>"; }
                    
}else{

if($name == $nomaud){
    $text = $_POST['text'];

    $fp = fopen("$nomaud.html", 'a');
    fwrite($fp, "<div class='msgaud'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}else{
    $text = $_POST['text'];

    $fp = fopen("$nomaud.html", 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}


}






}else{}
    


?>
