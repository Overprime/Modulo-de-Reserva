<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>ACTUALIZAR RQM</title>
<?php include('../header.php'); ?>
<?php 
//variable de Sesion:
$Solicitante=$_SESSION['starsoft'];

?>
</head>
<body>
<div class="container">

<div class="row clearfix">
<div class="col-md-12 column">
<div class="alert alert-dismissable alert-danger">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4>
ALERTA!!!
</h4> 
<p>Debe tener en cuenta que este proceso anulara el <strong>REQUERIMIENTO DE 
MATERIALES</strong>
seleccionado y cambiara el estado de la <strong>RESERVA</strong> a pendiente.</p>
<p>Solo se mostraran los requerimientos que su estado sea <strong>EMITIDO</strong>,
si el estado es diferente a  EMITIDO,se debe coordinar con el  <strong> Área de Almacen.</strong></p>
</div>
</div>
</div>



<div class="row clearfix">
<div class="col-md-3 column">
</div>
<div class="col-md-6 column">
<form action="../actualizar/actualizar-rqm.php" method="POST">
<div class="form-group">
<label class="text-primary">REQUERIMIENTO DE MATERIAL PENDIENTES</label>
<select name="requerimiento" class="form-control" required>
<option value="">Seleccione  el RQ de Material</option>
<?php
$link=Conectarse();
$Sql="SELECT NRORESERVA,REQ_NUMERO,REQ_PERSONAL_SOLIC,OT,CENTROCOSTO,T.TDESCRI FROM RESERVA_CAB AS RC INNER JOIN  [011BDCOMUN].DBO.INV_REQMATERIAL_CAB  AS CRM ON
RC.REQUERIMIENTO=CRM.REQ_NUMERO AND RC.ESTADO='01' AND REQ_ESTADO='00' AND  
REQ_PERSONAL_SOLIC='$Solicitante' INNER JOIN  [011BDCOMUN].DBO.TABAYU AS T 
ON REQ_PERSONAL_SOLIC=T.TCLAVE AND TCOD=12  ORDER BY NRORESERVA";
$result       =mssql_query($Sql) or die(mssql_error());
while ($row   =mssql_fetch_array($result)) {
?>
<option value ="<?php echo $row['REQ_NUMERO']?>">
<?php echo $row['NRORESERVA'].' --> '.$row['REQ_NUMERO'].' --> '.$row['OT'].$row['CENTROCOSTO'];?>
</option>
<?php }?>
</select>

</div>
<div class="form-group">

<button class="btn btn-block btn-lg btn-primary"  d="modal-105690" 
href="#modal-container-105690" role="button" data-toggle="modal">ANULAR RQM</button>

<div class="modal fade" id="modal-container-105690" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-center" id="myModalLabel">
Confirmación
</h4>
</div>
<div class="modal-body text-center">
¿Desea continuar con este proceso?
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Si deseo continuar</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</form>
</div>
</div>

</div>

</div>	
</div>
</div>

</div>
</body>
</html>