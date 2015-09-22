<?php 
include("../bd/conexion.php");

/*Almacenamos en variables los datos de formulario
notemos que se estan enviando en metodo POST*/

$RESERVAORIGEN=$_REQUEST['reservaorigen'];
$RESERVADESTINO=$_REQUEST['reservadestino'];
$link=Conectarse();

$Sql ="INSERT INTO [020BDCOMUN].DBO.RESERVA_DET(NRORESERVA,CODIGO,CANTIDAD,ITEM,DESCRIPCION,NUMERO_DOC,UNIDAD,CANT_PEND)
SELECT '$RESERVADESTINO',CODIGO,CANTIDAD,ITEM,DESCRIPCION,NUMERO_DOC,UNIDAD,CANT_PEND FROM
 [020BDCOMUN].DBO.RESERVA_DET WHERE NRORESERVA='$RESERVAORIGEN' ";

$Sql1="UPDATE  [020BDCOMUN].DBO.RESERVA_CAB SET  ESTADO='03' WHERE 
NRORESERVA='$RESERVAORIGEN'";

$Sql2="UPDATE  [020BDCOMUN].DBO.RESERVA_CAB SET  ESTADO='02' WHERE 
NRORESERVA='$RESERVADESTINO'";

$Sql3="DELETE FROM [020BDCOMUN].DBO.RESERVA_DET WHERE NRORESERVA='$RESERVAORIGEN'";

$result=mssql_query($Sql);			
if (!$result){echo "Error al guardar";}

else{

$result1=mssql_query($Sql1);
$result2=mssql_query($Sql2);
$result3=mssql_query($Sql3);

?>

<script>window.location ="/overprime/inventarios/moduloreserva/mensaje/trasladar-ni?numeroreserva="+<?php echo $RESERVAORIGEN; ?> ;</script>;
<?php

}



?>
