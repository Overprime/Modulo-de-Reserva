	
	
	
	
	<?php
	//Proceso de conexion con la base de datos
	include('bd/conexion.php');
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
	
	<!DOCTYPE html>
	<html lang="es">
	<head>
	<meta charset="utf-8">
	<title>.:MODULO DE RESERVA:.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="/overprime/inventarios/moduloreserva/css/bootstrap.min.css" rel="stylesheet">
	<link href="/overprime/inventarios/moduloreserva/css/style.css" rel="stylesheet">
	
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->
	
	<!-- Fav and touch icons -->
	<link rel="shortcut icon" href="/overprime/inventarios/moduloreserva/img/favicon.ico">
	
	<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/jquery.min.js"></script>
	<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/scripts.js"></script>
	<!-- Inicio Script convertir en mayuscula al ingresar	-->
	<script language    =""="JavaScript">
	function conMayusculas(field) {
	field.value         = field.value.toUpperCase()
	}
	</script>
	<!-- Fin Script convertir en mayuscula al ingresar-->
	</head>
	
	<body>
	</body>
	</html>
