<?php 

include("../bd/conexion.php"); 
$link=Conectarse(); 
$DOCUMENTO=$_REQUEST['documento']; 
$RESERVA=$_REQUEST['reservaorigen']; 



$Sql="UPDATE [020BDCOMUN].DBO.RESERVA_CAB SET ESTADO='00' WHERE 
NRORESERVA='$RESERVA'";

$Sql1="UPDATE [020BDCOMUN].DBO.AUD_RQ SET ESTADO='P'  WHERE 
CANUMDOC='$DOCUMENTO'";


$Sql2="DELETE FROM  [020BDCOMUN].DBO.RESERVA_DET WHERE 
NRORESERVA='$RESERVA'";

$result         =mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{
$result1         =mssql_query($Sql1);
$result2         =mssql_query($Sql2);

?>

<script>alert('DATOS LIBERADOS CORRECTAMENTE');</script>
<script>

window.location = "/overprime/inventarios/moduloreserva/consulta/ni";
</script>

<?php

}





?> 