<?php
header("Content-type: application/vnd.ms-excel; name='excel' ");
header("Content-Disposition: filename=verificacion-de-codigos.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo(utf8_decode($_POST['datos_a_enviar'])); 
?>