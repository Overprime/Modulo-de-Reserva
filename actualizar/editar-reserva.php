<?php 
include('../bd/conexion.php');



$Numeroreserva=$_REQUEST['numeroreserva'];
$Codigo=$_REQUEST['codigo'];
$Cantidad=$_REQUEST['cantidad'];
/*Insertamos los nuevos Datos*/

$link=Conectarse();


$Sql ="IF EXISTS(SELECT * FROM [020BDCOMUN].DBO.RESERVA_DET  WHERE
CODIGO='$Codigo' AND NRORESERVA='$Numeroreserva')
UPDATE [020BDCOMUN].DBO.RESERVA_DET  SET CODIGO='$Codigo',
CANTIDAD=CANTIDAD+$Cantidad,CANT_PEND=CANTIDAD+$Cantidad
where NRORESERVA='$Numeroreserva'and CODIGO='$Codigo'  
ELSE
INSERT INTO[020BDCOMUN].DBO.RESERVA_DET(NRORESERVA,CODIGO,CANTIDAD,CANT_PEND) VALUES('$Numeroreserva',
	'$Codigo','$Cantidad','$Cantidad')";

$result=mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{


$result1=mssql_query($Sql1);

?>
<script>



window.location = "../pages/editar-reserva?reserva="+<?php echo $Numeroreserva; ?>;
</script>

<?php

}



?>
