<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<?php include('../bd/conexion.php'); 
$Codigo=$_REQUEST['codigo'];
$Descripcion=$_REQUEST['descripcion'];
$Cantidad=$_REQUEST['cantidad'];
$Reserva=$_REQUEST['reserva'];


?>
<title>TRASLADAR</title>
<link href="/overprime/inventarios/moduloreserva/css/bootstrap.min.css" rel="stylesheet">
<link href="/overprime/inventarios/moduloreserva/css/style.css" rel="stylesheet">
<link rel="shortcut icon" href="/overprime/inventarios/overprime/inventarios/moduloreserva/img/favicon.ico">
<script type="text/javascript" src="/overprime/inventarios/overprime/inventarios/moduloreserva/js/jquery.min.js"></script>
<script type="text/javascript" src="/overprime/inventarios/overprime/inventarios/moduloreserva/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/overprime/inventarios/overprime/inventarios/moduloreserva/js/scripts.js"></script>
</head>
<body>
<div class="container">	
<h3 class="text-primary">FORMULARIO DE TRASLADO</h3>
<div class="row clearfix">
<div class="col-md-5 column">

<div class="row clearfix">
<div class="col-md-12 column">
<form action="../actualizar/trasladar.php" method="POST" autocomplete="Off">
<input type="hidden" name="reservaorigen" value="<?php echo $Reserva ?>">
<label for="">Código:</label>
<input type="text" name="codigo" class="form-control" value="<?php echo $Codigo; ?>"
readonly>
<label for="">Descripción:</label>
<textarea name="" id="" cols="30" rows="2" class="form-control" readonly="">
<?php echo utf8_decode($Descripcion); ?>
</textarea>
<label for="">Cantidad Actual:</label>
<input type="text" name="cantidadactual" class="form-control" value="<?php echo $Cantidad; ?>"
readonly>
<label for="">Cantidad a Trasladar:</label>
<input type="number" name="cantidad" min='1' max="<?php echo $Cantidad; ?>" class="form-control"
required>
</div>
</div>
</div>
<div class="col-md-4 column">
<div class="row clearfix">
<div class="col-md-12 column">

<label for="">Reserva de Destino</label>
<select name="reservadestino" id="" class="form-control" required>
<option value="">Seleccione la reserva...</option>
<?php
$link=Conectarse();
$Sql="SELECT NRORESERVA,OT,TDESCRI,CENTROCOSTO FROM [020BDCOMUN].DBO.RESERVA_CAB AS C 
INNER JOIN [011BDCOMUN].DBO.TABAYU AS T ON C.SOLICITANTE=T.TCLAVE AND TCOD='12'
WHERE ESTADO='00' AND NRORESERVA NOT LIKE '$Reserva' ORDER BY NRORESERVA";
$result       =mssql_query($Sql) or die(mssql_error());
while ($row   =mssql_fetch_array($result)) {
?>
<option value ="<?php echo $row['NRORESERVA']?>"><?php echo $row['NRORESERVA'].' ----> '.$row['OT'].$row['CENTROCOSTO'].' ----> '.$row['TDESCRI']?></option>
<?php }?>
</select>
</div>
</div>
</div>
</div>
<div class="row clearfix">
<div class="col-md-5 column">
<br>
	<button type="submit" class="btn btn-lg btn-success btn-block" >TRASLADAR</button>
	</form>
</div>
</div>
</div>
</body>
</html>