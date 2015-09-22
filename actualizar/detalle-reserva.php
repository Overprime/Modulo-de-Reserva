	<?php  
	include('../bd/conexion.php');
	$Numeroreserva=$_REQUEST['reserva'];
	$Codigo=$_REQUEST['codigo'];
	$Cantidad=$_REQUEST['cantidad'];
	
	
	$link=Conectarse();
	$Sql="UPDATE [020BDCOMUN].DBO.RESERVA_DET SET CANTIDAD='$Cantidad',CANT_PEND='$Cantidad'
	WHERE CODIGO='$Codigo' AND NRORESERVA='$Numeroreserva'";
	
	
	$result         =mssql_query($Sql);
	
	if (!$result){echo "Error al guardar";}
	else{
	
	?>
	<script type="text/javascript">alert('CANTIDAD ACTUALIZADA');</script>
	<script>
	
	window.location = "/overprime/inventarios/moduloreserva/pages/editar-reserva-almacen?reserva="+<?php echo $Numeroreserva; ?>;
	</script>
	
	<?php
	
	}
	
	
	
	?>
