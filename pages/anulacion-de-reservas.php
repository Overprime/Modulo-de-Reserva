<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Anulación de Reservas</title>
<?php include('../header.php'); ?>
<?php //VARIABLE DE SESION:
$IDUSUARIO=$_SESSION['id_usuario'];

?>
</head>
<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-6 column">
<form action="../actualizar/anular-reserva.php" method="POST">

<div class="form-group">

<label class="text-success">RESERVA POR ORDEN DE TRABAJO:</label>
<select name="reserva" class="form-control" required>
<option value="">Seleccione la reserva...</option>
<?php
$link=Conectarse();
$Sql="SELECT C.NRORESERVA,C.OT,C.USUARIO,C.CENTROCOSTO,C.TIPO FROM [020BDCOMUN].DBO.RESERVA_CAB AS C
WHERE C.ESTADO='00' AND C.USUARIO='$IDUSUARIO' AND C.TIPO='ot-cc'
AND C.NRORESERVA NOT IN (SELECT D.NRORESERVA FROM [020BDCOMUN].DBO.RESERVA_DET AS D)
ORDER BY C.NRORESERVA";
$result       =mssql_query($Sql) or die(mssql_error());
while ($row   =mssql_fetch_array($result)) {
?>
<option value ="<?php echo $row['NRORESERVA']?>"><?php echo $row['NRORESERVA'].'--->'.$row['OT'].$row['CENTROCOSTO']?>
</option>
<?php }?>
</select>
</div>
<div class="form-group">
<button type="button" class="btn btn-success btn-block"
data-toggle="modal" data-target=".bs-example-modal-s1">ANULAR RESERVA  X  OT</button>

<!-- Small modal -->
<div class="modal fade bs-example-modal-s1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
<h4 class="modal-title text-center text-success" id="mySmallModalLabel">ANULACION DE RESERVAS</h4>
</div>
<div class="modal-body text-center">
La reserva seleccionada sera anulada y no  podra volver a utilzarla.  <br>
¿Desea continuar?
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Si deseo continuar</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>


</form>
</div>

<div class="col-md-6 column">

<form action="../actualizar/anular-reserva.php" method="POST">

<div class="form-group">

<label class="text-primary">RESERVA POR CENTRO DE COSTO:</label>
<select name="reserva" class="form-control" required>
<option value="">Seleccione la reserva...</option>
<?php
$link=Conectarse();
$Sql="SELECT C.NRORESERVA,C.OT,C.USUARIO,C.CENTROCOSTO,C.TIPO FROM [020BDCOMUN].DBO.RESERVA_CAB AS C
WHERE C.ESTADO='00' AND C.USUARIO='$IDUSUARIO' AND C.TIPO='cc'
AND C.NRORESERVA NOT IN (SELECT D.NRORESERVA FROM [020BDCOMUN].DBO.RESERVA_DET AS D)
ORDER BY C.NRORESERVA";
$result       =mssql_query($Sql) or die(mssql_error());
while ($row   =mssql_fetch_array($result)) {
?>
<option value ="<?php echo $row['NRORESERVA']?>"><?php echo $row['NRORESERVA'].'--->'.$row['OT'].$row['CENTROCOSTO']?>
</option>
<?php }?>
</select>


</div>

<div class="form-group">
<button type="button" class="btn btn-primary btn-block"
data-toggle="modal" data-target=".bs-example-modal-s2">ANULAR RESERVA</button>

<!-- Small modal -->
<div class="modal fade bs-example-modal-s2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
<h4 class="modal-title text-center text-success" id="mySmallModalLabel">ANULACION DE RESERVAS</h4>
</div>
<div class="modal-body text-center">
La reserva seleccionada sera anulada y no  podra volver a utilzarla.  <br>
¿Desea continuar?
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Si deseo continuar</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</div>


</form>
</div>
</div>
</div>
</body>
</html>