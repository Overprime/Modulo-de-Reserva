	<?php 
	
	//Iniciar Sesion
	session_start();
	
	//Validar si se esta ingresando con sesion correctamente
	if (!$_SESSION){
	echo '<script language = javascript>
	alert("usuario no autenticado")
	self.location = "/overprime/inventarios/moduloreserva/"
	</script>';
	}
	
	$id_usuario = $_SESSION['id_usuario'];
	
	
	
	
	include("../../bd/conexion.php"); 
	$link=Conectarse(); 
		
	$Sql="DELETE FROM [020BDCOMUN].DBO.DATOS_RSV  WHERE  USUARIO='$id_usuario'";
	$Sql1="DELETE FROM [020BDCOMUN].DBO.PRE_REQUISD  WHERE  USUARIO='$id_usuario'";

	$result=mssql_query($Sql);
	
	if (!$result){echo "Error al guardar";}
	else{
	
	$result1=mssql_query($Sql1);
	
	?>
	<script>
	
	window.location = "/overprime/inventarios/moduloreserva/archivo/pages/cargar";
	</script>
	
	<?php
	
	}
	
	
	
	?>