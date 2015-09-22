<?php 

include("../bd/conexion.php"); 
$link=Conectarse(); 
$Codigo=$_REQUEST['codigo']; 
$Numeroreserva=$_REQUEST['reserva']; 



$Sql="DELETE FROM [020BDCOMUN].DBO.RESERVA_DET
WHERE NRORESERVA='$Numeroreserva' AND 
CODIGO='$Codigo'";
	
$result         =mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{



?>
<script type="text/javascript">alert('REGISTRO ELIMINADO');</script>
<script>

window.location = "/overprime/inventarios/moduloreserva/pages/editar-reserva-almacen?reserva="+<?php echo $Numeroreserva; ?>;
</script>

<?php

}





?> 