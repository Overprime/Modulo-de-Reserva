<?php 

include("../bd/conexion.php"); 
$link=Conectarse(); 
$IDCENCOSTOT=$_REQUEST['id']; 




$Sql="DELETE FROM [020BDCOMUN].DBO.CENCOSOT WHERE IDCENCOSOT='$IDCENCOSTOT'";

$result         =mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{



?>
<script>

window.location = "/overprime/inventarios/moduloreserva/consulta/cencos-ot";
</script>

<?php

}





?> 