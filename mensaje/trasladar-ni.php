<!DOCTYPE html>
<html lang="es">
<head>
<?php 	
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
<a 
href="javascript:self.opener.location='/overprime/inventarios/moduloreserva/consulta/reservas-ni';
self.close()"  class="btn btn-lg btn-success btn-block"> CERRAR PARA ACTUALIZAR LA INFORMACIÓN </a>
</div>
</div>

</div>

</body>
</html>