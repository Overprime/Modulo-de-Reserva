	<?php  
	//Iniciar Sesion
	session_start();
	$IDUSUARIO = $_SESSION['id_usuario'];
	include('../bd/conexion.php');
	
	$CODIGOACTUAL=$_REQUEST['codigoactual']; 
	$CODIGONUEVO=$_REQUEST['codigonuevo'];
	$CANTIDADNUEVA=$_REQUEST['cantidadnueva'];
	$CANTIDADACTUAL=$_REQUEST['cantidadactual'];
	$TIPO=$_REQUEST['tipo'];
	
	$link=Conectarse();
	$Sql="UPDATE [020BDCOMUN].DBO.DATOS_RSV SET CANTIDAD='$CANTIDADNUEVA',CODIGO='$CODIGONUEVO'
	WHERE CODIGO='$CODIGOACTUAL' AND CANTIDAD='$CANTIDADACTUAL' AND  USUARIO='$IDUSUARIO' 
	AND TIPO='$TIPO'";
	
	
	$result         =mssql_query($Sql);
	
	if (!$result){echo "Error al guardar";}
	else{
	
	?>
	
	<script type="text/javascript">alert('SE ACTUALIZO CORRECTAMENTE');</script>
	
	<?php 
	
	if ($TIPO=="OT-CC") {
	?>
	<script>
	window.location = "/overprime/inventarios/moduloreserva/archivo/pages/consulta"
	</script>
	<?php
	}
	else if ($TIPO=="CC") {
	?>
	<script>
	window.location = "/overprime/inventarios/moduloreserva/archivo/pages/consulta-sin-ot"
	</script>
	<?php
	}
	else{echo "error";}
	?>
	}
	
	
	<?php
	
	}
	
	
	
	?>
