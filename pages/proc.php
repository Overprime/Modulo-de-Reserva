<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Document</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<?php include('../bd/conexion.php');

$OT=$_REQUEST['q'];

 ?>
</head>
<body>
<!-- Inicio de  Tipos de equipos-->
<?php 
$link=Conectarse();
$res=mssql_query("SELECT  CODIGOCENTROCOSTO FROM [020BDCOMUN].DBO.CENCOSOT	WHERE CODIGOOT='$OT'",$link)
?>
<label >CENTRO DE COSTO</label>
<select name="centro" class="form-control" title='SELECCIONE EL TIPO'>
<?php
while($fila=mssql_fetch_array($res)){
?>
<option value="<?php echo $fila[CODIGOCENTROCOSTO]; ?>"><?php echo $fila[CODIGOCENTROCOSTO]; ?></option>
<?php } ?>
</select>   
<!-- Fin  de  tipos de equipo-->
</body>
</html>
