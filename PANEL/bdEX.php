<?php
function ConectarEX($bdEX) {
				 $host = 'localhost';
				 $usuario = 's18ea85d_fran';
				 $pass = 'df6s8ref34';
				 if (!($linkEX=mysql_connect($host, $usuario, $pass)))
				 {
				 		exit();
				 }

				 if (!mysql_select_db($bdEX,$linkEX))
				 {
				 		exit();
				 }
				 
				 return $linkEX;
}
?>
