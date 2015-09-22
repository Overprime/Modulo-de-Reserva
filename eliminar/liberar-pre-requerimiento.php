<?php 

include("../bd/conexion.php"); 
$link=Conectarse(); 
$Usuario=$_REQUEST['usuario']; 



$Sql="DELETE FROM [020BDCOMUN].DBO.PRE_REQUISD  WHERE  USUARIO='$Usuario'";

$result         =mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{



?>
<script type="text/javascript">alert('DATOS LIBERADOS CORECTAMENTE');</script>
<script>

window.location = "/overprime/inventarios/moduloreserva/pages/pre-requerimiento";
</script>

<?php

}





?> 