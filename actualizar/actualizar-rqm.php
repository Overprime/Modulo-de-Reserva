<?php 

$Requerimiento=$_REQUEST['requerimiento'];
include('../bd/conexion.php');
$link=Conectarse();
$sql="SELECT TOP 1 NRORESERVA FROM RESERVA_CAB  WHERE REQUERIMIENTO='$Requerimiento'";
$result       =mssql_query($sql,$link);
if ($row      =mssql_fetch_array($result)) {
mssql_field_seek($result,0);
while ($field =mssql_fetch_field($result)) {

}do {
/*Almacenamos los  datos en variables*/

$Reserva        =$row[0];

} while ($row =mssql_fetch_array($result));

}else { 
?>

<?php 
} 

?>




<?php  
$link=Conectarse();
$Sql="UPDATE [011BDCOMUN].DBO.INV_REQMATERIAL_CAB SET REQ_ESTADO='06'
WHERE REQ_NUMERO='$Requerimiento'";

$Sql1="UPDATE[020BDCOMUN].DBO.RESERVA_CAB SET ESTADO='00',REQUERIMIENTO=''
WHERE REQUERIMIENTO='$Requerimiento'";

$Sql2="UPDATE [020BDCOMUN].DBO.RESERVA_DET SET REQUERIMIENTO=''  WHERE REQUERIMIENTO='$Requerimiento'";


$result         =mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{


$result1=mssql_query($Sql1);
$result2=mssql_query($Sql2);

?>

<?php 	

header('Location: /overprime/inventarios/moduloreserva/mensaje/actualizar-rqm?rq='.urlencode($Requerimiento).'&rs='.urlencode($Reserva));

 ?>

<?php

}



?>
