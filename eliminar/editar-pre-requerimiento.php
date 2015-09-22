<?php 

include("../bd/conexion.php"); 
$link=Conectarse(); 
$Codigo=$_REQUEST['codigo']; 
$Usuario=$_REQUEST['usuario']; 



$Sql="DELETE FROM [020BDCOMUN].DBO.PRE_REQUISD  WHERE  CODIGOPRE_REQUISD='$Codigo' 
AND USUARIO='$Usuario'";

$result         =mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{



?>
<script>

window.location = "/overprime/inventarios/moduloreserva/pages/pre-requerimiento";
</script>

<?php

}





?> 