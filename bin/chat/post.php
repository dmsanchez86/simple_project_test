<?
session_start();
if(isset($_SESSION['name'])){

    
    
if(isset($_POST["userdona"])){
    $text = $_POST['userdona'];

    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgdona'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<img src='img/coins.png' style='width:auto; height:auto; display: inline-block; margin:5px;'><br></div>");
    fclose($fp);
}else{
    $text = $_POST['text'];

    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}

    
    
    
}
?>
