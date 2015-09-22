<!DOCTYPE html>
<html lang="es">
<head>
<?php 	
session_start();
$IDUSUARIO=$_SESSION['id_usuario'];


$Reserva=$_REQUEST['numeroreserva'];

?>
<meta charset="UTF-8">
<title>MENSAJE</title>
<link href="/overprime/inventarios/moduloreserva/css/bootstrap.min.css" rel="stylesheet">
<link href="/overprime/inventarios/moduloreserva/css/style.css" rel="stylesheet">
<link rel="shortcut icon" href="/overprime/inventarios/moduloreserva/img/favicon.ico">
<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/jquery.min.js"></script>
<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/scripts.js"></script>
</head>
<body>

<div class="container">	
<div class="row clearfix">
<br>	

<div class="col-md-6 column">	
<center>
<img src="../img/shopping-cart.png" width="300"
class="img-responsive">
</center>

</div>
<div class="col-md-4 column">
<h2 class="text-primary text-center">
EL TRASLADO SE REALIZO EXITOSAMENTE.
</h2>

<br>	

<?php 
if ($IDUSUARIO=='18') {
?>

<a 
href="javascript:self.opener.location=
'/overprime/inventarios/moduloreserva/pages/editar-reserva-servicios?reserva=<?php echo $Reserva; ?>';
self.close()"  class="btn btn-lg btn-success btn-block"> CERRAR PARA ACTUALIZAR LA INFORMACIÓN </a>


<?php
}
else if($IDUSUARIO=='9')
{
?>

<a 
href="javascript:self.opener.location=
'/overprime/inventarios/moduloreserva/pages/editar-reserva-fabricacion?reserva=<?php echo $Reserva; ?>';
self.close()"  class="btn btn-lg btn-success btn-block"> CERRAR PARA ACTUALIZAR LA INFORMACIÓN </a>
<?php

}

?>






</div>
</div>

</div>

</body>
</html>