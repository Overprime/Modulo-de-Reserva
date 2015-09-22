	<?php  
	include('../bd/conexion.php');
	$Numeroreserva=$_REQUEST['reserva'];

	
	$link=Conectarse();
	$Sql="UPDATE [020BDCOMUN].DBO.RESERVA_CAB SET ESTADO='02'
	WHERE NRORESERVA='$Numeroreserva'";
	
	
	$result         =mssql_query($Sql);
	
	if (!$result){echo "Error al guardar";}
	else{
	
	?>
	<script type="text/javascript">alert('Reserva <?php echo $Numeroreserva; ?> Anulada');</script>
	<script>
	
	window.location = "/overprime/inventarios/moduloreserva/pages/anulacion-de-reservas";
	</script>
	
	<?php
	
	}
	
	
	
	?>
