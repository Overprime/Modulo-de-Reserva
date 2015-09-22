
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>.:MODULO DE RESERVA:.</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<script language="javascript">
function recargar(){  
var variable_post="STOCK ACTUALIZADO";
$.post("/overprime/inventarios/moduloreserva/miscript.php", { variable: variable_post }, function(data){
$("#recargado").html(data);
});     
}
</script>

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
<!-- Inicio Script convertir en mayuscula al ingresar -->
<script language    =""="JavaScript">
function conMayusculas(field) {
field.value         = field.value.toUpperCase()
}
</script>
<!-- Fin Script convertir en mayuscula al ingresar-->
</head>

<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-12 column">
<nav class="navbar navbar-default">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" 
data-target="#bs-example-navbar-collapse-1">
<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span>
<span class="icon-bar"></span><span class="icon-bar"></span></button>
<a class="navbar-brand" href="/overprime/inventarios/moduloreserva/home">Inicio</a>
</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">TRANSACCIONES<strong class="caret"></strong></a>
<ul class="dropdown-menu">
<li>
<a href="/overprime/inventarios/moduloreserva/consulta/reservas">RESERVAS</a>
</li>
<li>
<a href="/overprime/inventarios/moduloreserva/consulta/rq-materiales">REQUERIMIENTO DE MATERIALES</a>
</li>
</ul>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">PROCESOS<strong class="caret"></strong></a>
<ul class="dropdown-menu">
<li>
   <a id="modal-119597" href="#modal-container-119597"
    role="button" class="" data-toggle="modal">IMPORTAR DESDE DOCUMENTO EXCEL</a>
</li>

<li><a href="/overprime/inventarios/moduloreserva/archivo/pages/consulta">CONSULTAR DATOS IMPORTADOS DESDE EXCEL</a></li>
 <li>
<a href="/overprime/inventarios/moduloreserva/pages/pre-requerimiento">CONSULTAR PRE-REQUERIMIENTO</a></li>
<li class="divider"></li>
<li><a href="/overprime/inventarios/moduloreserva/consulta/ni">TRANSFERIR DESDE NOTA DE INGRESO</a></li>
<li class="divider"></li>
 <li>
<a id="modal-2000" href="#modal-container-2000"
    role="button" class="" data-toggle="modal">IMPORTAR DESDE DOCUMENTO EXCEL RQ SIN OT</a>
</li>
 <li>
<a href="/overprime/inventarios/moduloreserva/pages/pre-requerimiento-so">CONSULTAR PRE-REQUERIMIENTO SIN OT</a>
</li>
<li class="divider"  ></li>
<li>
<a href="/overprime/inventarios/moduloreserva/pages/verificar-pedidos">VERIFICAR PEDIDOS-RESERVA</a>
</li>
</ul>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">TABLAS DE AYUDA<strong class="caret"></strong></a>
<ul class="dropdown-menu">
<li>
<a href="/overprime/inventarios/moduloreserva/consulta/cencos-ot">
ASOCIAR CENTRO DE COSTO</a>
</li>
<li>
<a href="/overprime/inventarios/moduloreserva/consulta/nota-salida">
NOTA-SALIDA</a>
</li>
<li>
<a href="/overprime/inventarios/moduloreserva/busqueda/articulos">
CONSULTA DE ARTICULOS</a>
</li>
<li>
<a href="/overprime/inventarios/moduloreserva/consulta/reserva">
CONSULTA HISTORICA DE RESERVAS</a>
</li>
</ul>
</li>
</ul>
<form class="navbar-form navbar-left" role="search">
<div class="form-group">
<a href="/overprime/inventarios/moduloreserva/actualizar/actualizar-stock.php" class="btn btn-primary">ACTUALIZAR</a>

</div> 
</form>
<ul class="nav navbar-nav navbar-right">
<li>
<a href="#"><i class="glyphicon glyphicon-user text-success"></i>
<?php echo $_SESSION['nombres'].' '.$_SESSION['apellidos']; ?></a>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong class="caret"></strong></a>
<ul class="dropdown-menu">
<li>
<a href="/overprime/inventarios/moduloreserva/adios">Salir</a>
</li>



</ul>
</li>
</ul>
</div>

</nav>
</div>
</div>
</div>
</body>


<!-- INICIO MODAL VALIDAR CARGA DE EXCEL -->

<div class="modal fade" id="modal-container-119597" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title" id="myModalLabel">
VALIDACIÓN DE CARGA DE EXCEL....
</h4>
</div>
<div class="modal-body">
<a href="/overprime/inventarios/moduloreserva/eliminar/validar-carga.php"
class="btn btn-success">CARGAR EXCEL</a>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
</div>

</div>

</div>
<!-- FIN MODAL VALIDAR CARGA DE EXCEL -->
</html>
