<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>MENSAJE DE CONFIRMACIÓN</title>
<?php include('../header.php');
//variables
$Requerimiento=$_REQUEST['rq']; 
$Reserva=$_REQUEST['rs'];
 ?>
</head>
<body>
<div class="container">


<div class="row clearfix">

<div class="col-md-2 column">
</div>
<div class="col-md-8 column">
<div class="jumbotron">
<h2 class="text-center text-success">
ACTUALIZACIÓN EXITOSA 
</h2>
<p class="text-center">
El Requerimiento de Materiales  <strong class="text-primary"> N° <?php echo $Requerimiento; ?></strong>
 fue anulado  y la Reserva  <strong class="text-primary"> N° <?php echo $Reserva; ?> </strong>  paso a  pendiente ,ya puede ser  editada y generar otro Requerimiento de 
Materiales		. 
</p>
<p>
<center>
<a class="btn btn-success btn-lg "
href="/overprime/inventarios/moduloreserva/consulta/reservas">Consultar Reservas</a>
</center>
</p>
</div>
</div>

</div>
</div>
</body>
</html>