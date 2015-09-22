
	<?php
	//Proceso de conexion con la base de datos
	include('../bd/conexion.php');
	$link=Conectarse();

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

	$consulta= "SELECT apellidos,dni FROM [020BDCOMUN].DBO.USUARIOS
	WHERE id_usuario='".$id_usuario."'"; 
	$resultado= mssql_query($consulta,$link) or die (mssql_error());
	$fila=mssql_fetch_array($resultado);
	$apellidos = $fila['apellidos'];
	$edad = $fila['edad'];
	?>
