
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
<link rel="stylesheet" type="text/css" 
href="/overprime/inventarios/moduloreserva/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/overprime/inventarios/moduloreserva/css/sticky-footer.css">
<link rel="shortcut icon" href="/overprime/inventarios/moduloreserva/img/favicon.ico">

<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/jquery.min.js"></script>
<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/scripts.js"></script>
<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/ajax.js"></script>
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
<a href="http://192.168.1.27/overprime/inventarios/moduloreserva/consulta/reservas">RESERVAS</a>
</li>
<li>
<a href="http://192.168.1.27/overprime/inventarios/moduloreserva/consulta/rq-materiales">REQUERIMIENTO DE MATERIALES</a>
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
<li class="divider"></li>
<li><a href="/overprime/inventarios/moduloreserva/archivo/pages/consulta">DATOS DESDE EXCEL OT / CC</a></li>
<li><a href="/overprime/inventarios/moduloreserva/archivo/pages/consulta-sin-ot">DATOS DESDE EXCEL CC</a></li>
<li>
<a href="/overprime/inventarios/moduloreserva/pages/pre-requerimiento">PRE-REQUERIMIENTO</a></li>
<li>
<a href="/overprime/inventarios/moduloreserva/pages/lista-de-verificacion">LISTA DE VERIFICACIÓN</a></li>
<li class="divider"></li>
<li><a href="/overprime/inventarios/moduloreserva/consulta/ni-new">
TRANSFERIR DESDE NOTA DE INGRESO</a>
</li>
<!--  
<li><a href="/overprime/inventarios/moduloreserva/consulta/ni-new">
TRANSFERIR DESDE NOTA DE INGRESO (26/05/2015)</a>
</li>
-->
<li class="divider"></li>
<li>
<a href="/overprime/inventarios/moduloreserva/pages/verificar-pedidos">VERIFICAR PEDIDOS-RESERVA</a>
</li>
</ul>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">TABLAS DE AYUDA<strong class="caret"></strong></a>
<ul class="dropdown-menu">
<?php 
if ($id_usuario==45 || $id_usuario==2 || $id_usuario==9
|| $id_usuario==56 || $id_usuario==6 || $id_usuario==5
|| $id_usuario==4 || $id_usuario==43) {
echo "<li>
<a href='/overprime/inventarios/moduloreserva/consulta/cencos-ot'>
ASOCIAR CENTRO DE COSTO</a>
</li>
";
}

else {echo " ";}

?>
<li class="divider"></li>
<li>
<a href="/overprime/inventarios/moduloreserva/pages/anulacion-de-reservas">
ANULACIÓN DE RESERVAS</a>
</li>
<li>
<a href="/overprime/inventarios/moduloreserva/pages/actualizar-rqm">
ANULACIÓN DE RQ DE MATERIALES</a>
</li>
<li class="divider"></li>
<li>
<a href="/overprime/inventarios/moduloreserva/consulta/nota-salida">
ACTUALIZAR OT x NS</a>
</li>
<li>
<a href="/overprime/inventarios/moduloreserva/busqueda/articulos" target="_blank">
CONSULTA DE ARTICULOS</a>
</li>
<li>
<a href="/overprime/inventarios/moduloreserva/consulta/reserva" target="_blank">
CONSULTA HISTORICA DE RESERVAS</a>
</li>
</ul>
</li>

<?php if ($id_usuario==4 || $id_usuario==5|| $id_usuario==6 || $id_usuario==45||$id_usuario==58) {
?>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">ACTUALIZACIÓN<strong class="caret"></strong></a>
<ul class="dropdown-menu">
<li>
<a href="/overprime/inventarios/moduloreserva/pages/grabar-requerimiento">
GRABAR REQUERIMIENTO</a>
</li>

</ul>
</li>
<?php
} 

else{echo " ";}

?>


<?php if ($id_usuario==2) {
?>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">MANTENIMIENTO<strong class="caret"></strong></a>
<ul class="dropdown-menu">
<li>
<a href="/overprime/inventarios/moduloreserva/consulta/usuarios">
CREACIÓN DE USUARIOS</a>
</li>
<li>
<a href="/overprime/inventarios/moduloreserva/pages/actualizar-rqm">
ACTUALIZAR RQM</a>
</li>
</ul>
</li>
<?php
} 

else{echo " ";}

?>


</ul>





<ul class="nav navbar-nav navbar-right">
<li>
<a href="#"><i class="glyphicon glyphicon-user text-success"></i>
<?php echo utf8_encode($_SESSION['nombres']).' '.$_SESSION['apellidos']; ?></a>
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

<!-- INICIO MODAL VALIDAR CARGA DE EXCEL SIN OT -->

<div class="modal fade" id="modal-container-119597" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-success" id="myModalLabel">
CARGA DESDE  EXCEL....
</h4>
</div>
<div class="modal-body">
<a href="/overprime/inventarios/moduloreserva/eliminar/validar-carga.php"
class="btn btn-success">CARGAR EXCEL OT / CC</a>

<a href="/overprime/inventarios/moduloreserva/eliminar/validar-carga-sin-ot.php"
class="btn btn-primary">CARGAR EXCEL CC</a>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
</div>

</div>

</div>
<!-- FIN MODAL VALIDAR CARGA DE EXCEL SIN OT -->
</html>
