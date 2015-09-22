<?php 
include("../bd/conexion.php");
session_start();

$IDUSUARIO = $_SESSION['id_usuario'];
/*Almacenamos en variables los datos de formulario
notemos que se estan enviando en metodo POST*/

$Reservaorigen=$_REQUEST['reservaorigen'];
$Reservadestino=$_REQUEST['reservadestino'];
$Codigo=$_REQUEST['codigo'];
$Cantidad=$_REQUEST['cantidad'];
$link=Conectarse();

$Sql ="IF EXISTS(SELECT * FROM [020BDCOMUN].dbo.RESERVA_DET WHERE NRORESERVA='$Reservadestino' AND 
CODIGO='$Codigo') 
UPDATE [020BDCOMUN].dbo.RESERVA_DET SET CODIGO ='$Codigo',CANTIDAD=CANTIDAD+$Cantidad,
CANT_PEND=CANTIDAD+$Cantidad
WHERE NRORESERVA='$Reservadestino' AND CODIGO='$Codigo'
ELSE
INSERT INTO[020BDCOMUN].DBO.RESERVA_DET(NRORESERVA,CODIGO,CANTIDAD,CANT_PEND) 
SELECT '$Reservadestino',CODIGO,'$Cantidad',$Cantidad FROM [020BDCOMUN].DBO.RESERVA_DET AS R WHERE
NRORESERVA='$Reservaorigen' and CODIGO='$Codigo'";

$Sql1="UPDATE  [020BDCOMUN].DBO.RESERVA_DET SET
CANTIDAD=CANTIDAD-$Cantidad,CANT_PEND=CANTIDAD-$Cantidad WHERE NRORESERVA='$Reservaorigen'
AND CODIGO='$Codigo'";

$Sql2="DELETE FROM [020BDCOMUN].DBO.RESERVA_DET WHERE CANTIDAD=0";

/*$Sql3="INSERT INTO [020BDCOMUN].DBO.AUDITORIA
(RESERVAORIGEN,RESERVADESTINO,OPERACION,CODIGO_ARTICULO,CANTIDAD,
FECHA,HORA,NOMBRE_PC,NOMBRE_USUARIO,NRO_DOCUMENTO)
VALUES('$Reservaorigen',$Reservaorigen','$Reservadestino','T','$Codigo','$Cantidad',
GETDATE(),Convert(varchar(8),GetDate(), 108),'$ip','$nombreusuario',
'$Reservaorigen')";

$Sql3="INSERT INTO [020BDCOMUN].DBO.AUDITORIA
(NRO_DOCUMENTO,RESERVAORIGEN,RESERVADESTINO,NOMBRE_USUARIO,
OPERACION,NOMBRE_PC,FECHA,HORA,CODIGO_ARTICULO,CANTIDAD)
VALUES('$Reservaorigen','$Reservaorigen','$Reservadestino','$nombreusuario',
'T','$ip',GETDATE(),Convert(varchar(8),GetDate(), 108),
'$Codigo','$Cantidad')";*/



$result=mssql_query($Sql);			
if (!$result){echo "Error al guardar";}

else{

$result1=mssql_query($Sql1);
$result2=mssql_query($Sql2);
$result3=mssql_query($Sql3);

?>
<script type="text/javascript">alert('TRASLADO EXITOSO');</script>
<?php 

if ($IDUSUARIO==3) {
?>
<script>window.location 
="/overprime/inventarios/moduloreserva/pages/editar-reserva-almacen?reserva="+<?php echo $Reservaorigen; ?> ;</script>;
<?php
}
else if($IDUSUARIO==18) {
?>
<script>window.location 
="/overprime/inventarios/moduloreserva/pages/editar-reserva-servicios?reserva="+<?php echo $Reservaorigen; ?> ;</script>;
<?php
}
else if($IDUSUARIO==9) {
?>
<script>window.location 
="/overprime/inventarios/moduloreserva/pages/editar-reserva-fabricacion?reserva="+<?php echo $Reservaorigen; ?> ;</script>;
<?php
}
else {echo "error";}
?>
}
}

<?php

}



?>

