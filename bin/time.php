<?php

            #$link = mysql_connect("localhost","s18ea85d_fran","df6s8ref34");
            $link=mysql_connect("localhost", 'root', '');
            mysql_select_db("s18ea85d_lubricam", $link);


            //$idusu = $_GET["e"];
            //$resdos = mysql_query("SELECT * FROM registro WHERE (id = '$idusu')", $link);
             //       if (@$row = mysql_fetch_array($resdos)){
              //      $correo = $row[2];
               //     } else { return false; }

              $cortemd = $_GET["e"];
            $result = mysql_query("SELECT * FROM creditos WHERE correo = '$cortemd'", $link);
                    if (@$row = mysql_fetch_array($result)){
                    echo $row[1];
                    } else { return false; }
            mysql_close($link);



?>
