<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
</head>
<body>

<div class="container">
<div class="row clearfix">

<div class="col-md-12 column">

<div class="table-responsive">


<script type="text/javascript" language="javascript" src="js/jslistadoreserva.js"></script>

<table class="table table-bordered table-condensed" id="tabla_lista_reserva">
<thead>
<tr class="success">
<th>NRO.RESERVA</th>
<th>SOLICITANTE</th>
<th>OT /  CC</th>
<th>FECHA</th>
<th>ESTADO</th>
<th><i class="glyphicon glyphicon-zoom-in text-primary"></i></th>
</tr>
<?php require_once('../../bd/conexion.php');
$link=  Conectarse();
$listado=  mssql_query("SELECT C.NRORESERVA,T.TDESCRI,C.OT,
	C.CENTROCOSTO,CONVERT(VARCHAR,C.FECHA,105)AS FECHA,
(CASE C.ESTADO
WHEN '00' THEN 'PENDIENTE'
WHEN '01' THEN 'ATENDIDA'
WHEN '02' THEN 'PENDIENTE NI'
WHEN '03' THEN 'ANULADA'
END)AS ESTADOS   FROM [020BDCOMUN].DBO.RESERVA_CAB AS C
 INNER JOIN [011BDCOMUN].DBO.TABAYU AS T ON
 C.SOLICITANTE=T.TCLAVE WHERE TCOD='12'",$link);
?>

<tbody>
<?php
while($reg=  mssql_fetch_array($listado)) 
{
?>
<tr class="active">
<td><?php echo utf8_encode($reg['NRORESERVA']); ?></td>
<td><?php echo utf8_encode($reg['TDESCRI']) ?></td>
<td><?php echo $reg['OT'].$reg[CENTROCOSTO] ?></td>
<td><?php echo utf8_encode($reg['FECHA']) ?></td>
<td><?php echo utf8_encode($reg['ESTADOS']) ?></td>
<td><a href="detalle/reserva?id=<?php echo 	utf8_encode($reg['NRORESERVA']);?> &
solicitante=<?php echo utf8_encode($reg['TDESCRI']);?> &
ot=<?php echo $reg['OT'].$reg['CENTROCOSTO'];?> & 
estado=<?php echo utf8_encode($reg['ESTADOS']);?>"
><i class="glyphicon glyphicon-zoom-in text-primary"></i></a></td>









</tr>
<?php
}
?>
</tbody>
</table>

</div>

</div>
</div>

</div>

</body>
<?php 

/*Realizamos la consulta para  generar el 
codigoautomatico*/

$link=Conectarse();
$sql="SELECT CTNNUMERO FROM [020BDCOMUN].DBO.NUM_DOCCOMPRAS WHERE CTNCODIGO='RV' ";
$result       =mssql_query($sql,$link);
if ($row      =mssql_fetch_array($result)) {
mssql_field_seek($result,0);
while ($field =mssql_fetch_field($result)) {

}do {

$IDRESERVA=$row[0];

} while ($row =mssql_fetch_array($result));

}else { 

} 

$ReservaActual=$IDRESERVA+1;
?>
<!-- INICIO MODAL REGISTRAR -->
<div class="modal fade" id="modal-container-221645" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-primary" id="myModalLabel">
CREAR RESERVA
</h4>
</div>
<form action="../registrar/crear-reserva.php" method="POST">
<div class="modal-body">
<label for="">NÚMERO DE RESERVA:</label>
<input type="text" name="numeroreserva" class="form-control" 
value="<?php echo 	$ReservaActual; ?>" readonly>
<label for="">SOLICITANTE:</label>
<select name="solicitante" class="form-control" readonly>
<?php
$link=Conectarse();
$Sql="SELECT TCLAVE,TDESCRI FROM [011BDCOMUN].dbo.TABAYU 
WHERE TCOD='12' AND TCLAVE='$COD_SOLICITANTE' ORDER BY TDESCRI";
$result=mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option value ="<?php echo $row['TCLAVE']?>"><?php echo utf8_encode($row['TDESCRI'])?></option>
<?php }?>
</select>
<label for="">ORDEN DE FABRICACIÓN:</label>
<select name="ot" class="form-control" required>
<option value="">Seleccione la O/T...</option>
<?php
$link=Conectarse();
$Sql ="SELECT CODIGOOT FROM [020BDCOMUN].dbo.CENCOSOT
GROUP BY CODIGOOT ORDER BY CODIGOOT ";

$result=mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option class="text-primary" value="<?php echo $row['CODIGOOT']?>">
<?php echo $row['CODIGOOT']?></option>
<?php }?>
</select>

<input type="hidden" name="usuario"value="<?php echo $IDUSUARIO; ?>">
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">GRABAR</button>
<button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button> 
</form>
</div>
</div>

</div>

</div>

<!-- FIN MODAL REGISTRAR -->



</html>