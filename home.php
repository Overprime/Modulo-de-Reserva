<!DOCTYPE html>
<html lang="es">
<head>
<?php 

//Iniciar Sesion
session_start();
$AREA = $_SESSION['idarea']; ?>
<?php include('header.php'); ?>
<link rel="stylesheet" type="text/css" href="css/sticky-footer.css">
</head>
<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-12 column">
<div class="jumbotron">
<center>
<div class="form-group">
<?php 
if ($AREA==2) {
echo "<a class='btn btn-primary'
onclick='javascript:recargar();''><div id='recargado'>ACTUALIZAR STOCK</div></a>";
}
else{

echo "";
}

?>


</div> </center>

<h1 class="text-success text-center">
<a href="/overprime/inventarios/moduloreserva/AYUDA/Docs/stock-de-articulos.xlsx" class="btn btn-success btn-lg">DESCARGAR STOCK DE ARTICULOS</a></h1>
<center>
<img src="img/reservas.png" class="img-responsive">
<a id="modal-569433" href="#modal-container-569433" 
role="button" class="btn btn-primary" data-toggle="modal"><i class="fa fa-book fa-2x"></i>
&nbsp;CONOCIMIENTOS PREVIOS</a>
</p>
</center>
<p>
<p>

</p>
</div>
</div>
</div>
</div>


<footer class="footer">
<div class="container">
<p class="text-muted text-center">Área de TI Overprime</p>
</div>
</footer>
</body>

<!--  -->
<div class="modal fade" id="modal-container-569433" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title" id="myModalLabel">
CONOCIMIENTOS PREVIOS &nbsp;&nbsp; &nbsp;<i class="fa fa-book fa-4x text-primary"></i>
</h4> 
</div>
<div class="modal-body">
<ol>
<li>Para poder realizar el proceso de reserva nuestro documento base,debe ser el siguiente <a href="/overprime/inventarios/moduloreserva/AYUDA/Docs/carga-excel.xlsx">excel</a></li>
<li>Es importante que usted tenga creado un usuario solicitante en Starsoft,para interactuar
con este aplicativo,porque es un validación esencial para el proceso de reservas</li>
<li>Para poder crear una reserva por OT/CC se debe tener asociado la O/T y el Centro de costo
,si es que no logra vizualizarla comuniquese con el encargo de ese proceso.</li>
<li>Para el proceso de Pre-requerimiento,usted previamente debe  tener creado el requerimiento
de compra con su usuario solicitante y en detalle del requerimiento debe creado un solo registro
con un  articulo del tipo <strong>TEXTO</strong> con la descripción <strong>RESERVA</strong>,
esta restricciones permiten validar el RQ y poder vizualizarlo en el aplicativo de reservas. </li>
<li>Para generar los requerimientos de compra,solo por el centro de costo del área,
debemos utilzar el aplicativo <a href="http://192.168.1.21/overprime/compras/carga-de-datos/"
target="_blank" >carga de datos</a>,que actualmente ya se viene utilizando.</li>
<li>Los usuarios solo pueden agregar articulos a su reserva.</li>
<li>Los jefes de área solo los únicos,que pueden trasladar los articulos de las
reservas del personal del área.</li>
<li>El personal de álmacen es el único que puede realizar 
a la actulización de la cantidades reservadas y eliminarlas.</li>
<!-- 
<li><strong>La información mencionada lineas  arriba fue desarrollada con el asesoramiento
del Sr. Manuel Matos(Jefe de almacen),por ser la persona que conoce mejor proceso 
reservas de articulos,dentro de la empresa Overprime.</strong></li> -->
<li>Descarga de <a href="http://192.168.1.27/overprime/inventarios/moduloreserva/AYUDA/Docs/PRESENTACION.pptx">Presentación</a> y <a href="http://192.168.1.27/overprime/inventarios/moduloreserva/AYUDA/Docs/MANUAL-DE-RESERVAS.pdf" target="_blank">Manual</a>.</li>
</ol>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
</div>
</div>

</div>

</div>

<!--  -->
</html>





