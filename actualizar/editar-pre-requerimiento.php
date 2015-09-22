<?php 
include('../bd/conexion.php');

$Codigo=$_REQUEST['codigo'];
$Cantidad=$_REQUEST['cantidad'];
$Usuario=$_REQUEST['usuario'];
/*Insertamos los nuevos Datos*/

$link=Conectarse();


$Sql ="UPDATE [020BDCOMUN].DBO.PRE_REQUISD SET CANTPRE_REQUISD='$Cantidad'
WHERE CODIGOPRE_REQUISD='$Codigo'  AND USUARIO='$Usuario'";

$result=mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{


?>
<script>



window.location = "/overprime/inventarios/moduloreserva/pages/pre-requerimiento";
</script>

<?php

}



?>
