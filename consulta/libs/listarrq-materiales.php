<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<?php
//VARIABLES DE SESION 
session_start();
$IDUSUARIO=$_SESSION['id_usuario'];	
$COD_SOLICITANTE=$_SESSION['starsoft'];
//echo "$COD_SOLICITANTE";
?>

<style type="text/css">
.centrar
{
text-align: center;
}
</style>

</head>
<body>

<div class="container">

<div class="row clearfix">
<div class="col-md-12 column">
<a id="modal-90561" href="#modal-container-90561"
role="button" class="btn btn-success" data-toggle="modal">CREAR REQUERIMIENTO</a>
</div>
</div>
<p>  <!-- LINEA DE SEPARACION ENTRE BOTON Y TABLA -->  </p>


<div class="row clearfix">

<div class="col-md-12 column">

<div class="table-responsive">


<script type="text/javascript" language="javascript" src="js/jslistadorq-materiales.js"></script>

<table class="table table-bordered table-condensed" id="tabla_lista_rq-materiales">
<thead>
<tr class="success">
<th width="30">RESERVA</th>
<th width="50">RQ. DE MATERIAL</th>
<th width="50" class="centrar">OT</th>
<th width="100" >SOLICITANTE</th>
<th width="80" class="centrar">FECHA DE EMISION</th>
<th width="100">FECHA DE AUTORIZACIÓN</th>
<th width="90" class="centrar">ESTADO</th> 
<th width="8" class="centrar"><i class="glyphicon glyphicon-folder-open text-primary"></i></th>
</tr>
<?php require_once('../../bd/conexion.php');
$link=  Conectarse();
$listado=  mssql_query("SELECT NRORESERVA,RC.OT,REQ_NUMERO,CONVERT(VARCHAR,REQ_FECHA_EMISION,101)AS FECHAE,CONVERT(VARCHAR,REQ_FECHA_AUTORI,105)AS FECHAA,
CASE REQ_ESTADO
WHEN  00 THEN 'EMITIDO'
WHEN  01 THEN 'APROBADA'
WHEN  03 THEN 'REC.PARCIAL'
WHEN  04 THEN 'REC.TOTAL'
WHEN  05 THEN 'LIQUIDADA'
WHEN  06 THEN 'ANULADA'
END  AS ESTADO,
T.TDESCRI,
CENCOST_CODIGO FROM [011BDCOMUN].dbo.INV_REQMATERIAL_CAB  AS C 
INNER JOIN [011BDCOMUN].DBO.TABAYU AS T ON C.REQ_PERSONAL_SOLIC=T.TCLAVE INNER JOIN 
[020BDCOMUN].DBO.RESERVA_CAB  AS RC ON 
C.REQ_NUMERO=RC.REQUERIMIENTO WHERE TCOD='12' AND 
REQ_ESTADO IN ('00','01') ORDER BY REQ_NUMERO  ",$link);
?>

<tbody>
<?php
while($reg=  mssql_fetch_array($listado)) 
{
?>
<tr class="active">

<td><?php echo utf8_encode($reg[NRORESERVA]); ?></td>
<td><?php echo utf8_encode($reg[REQ_NUMERO]); ?></td>
<td class="centrar"><?php echo utf8_encode($reg[OT]); ?></td>
<td><?php echo utf8_encode($reg[TDESCRI]); ?></td>
<td class="centrar"><?php echo utf8_encode($reg[FECHAE]); ?></td>
<td><?php echo utf8_encode($reg[FECHAA]); ?></td>
<td class="centrar"><?php echo utf8_encode($reg[ESTADO]); ?></td>
<td class="centrar"><a href="../pages/reporte-requerimiento?id=<?php echo $reg[REQ_NUMERO]; ?>" 
 target="_blank" class="btn btn-default"><i class="glyphicon glyphicon-folder-open text-primary"></i></a></td>
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
<div class="modal fade" id="modal-container-90561" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-primary" id="myModalLabel">
MIS RESERVAS CREADAS
</h4>
</div>
<div class="modal-body">
<div class="container">
<div class="row clearfix">
<div class="col-md-12 column">
<div class="table-responsive">

<table class="table table-bordered table-condensed">		
<thead>	
<tr class="success">	
<th>ID</th>
<th>SOLICITANTE</th>
<th>O/T</th>
<th>CC</th>
<th style="text-align: center"><i class="glyphicon glyphicon-edit"></i></th>
</tr>
</thead>

<?php 
//variable sesion usuario solicitante
$usuario=$_SESSION['id_usuario'];
$solicitante=$_SESSION['starsoft'];
$link=Conectarse();
$sql="SELECT CRV.NRORESERVA,CRV.OT,T.TDESCRI,CRV.USUARIO,CRV.TIPO,
CRV.CENTROCOSTO FROM [020BDCOMUN].DBO.RESERVA_CAB AS CRV
INNER JOIN [011BDCOMUN].DBO.TABAYU AS T ON CRV.SOLICITANTE=T.TCLAVE WHERE TCOD='12' AND 
CRV.ESTADO IN ('00','02') AND CRV.USUARIO='$IDUSUARIO' AND 
CRV.NRORESERVA IN (SELECT NRORESERVA FROM [020BDCOMUN].DBO.RESERVA_DET)
ORDER BY CRV.NRORESERVA DESC

";
$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("******NO HAY RESERVAS DISPONIBLES ACTUALMENTE****");
while($row=mssql_fetch_array($result))
{
?>
<tbody>	
<tr>			
<td><?php echo $row[NRORESERVA]; ?></td>
<td><?php echo $row[TDESCRI]; ?></td>
<td><?php echo $row[OT]; ?></td>
<td><?php echo $row[CENTROCOSTO]; ?></td>
<td style="text-align: center">
<?php 

if ($row[TIPO]=='cc') {
	?>
<form method="post" action="../pages/requerimiento-sin-ot">
	<input type="hidden" name="reserva" value="<?php echo $row[NRORESERVA]; ?>">
	<input type="hidden" name="cc" value="<?php echo $row[CENTROCOSTO]; ?>">
<button class="btn btn-default"><i class="glyphicon glyphicon-edit text-primary"></i></button>
</form>
<?php
}
else{
?>
<form method="post" action="../pages/requerimiento">
	<input type="hidden" name="reserva" value="<?php echo $row[NRORESERVA]; ?>">
	<input type="hidden" name="ot" value="<?php echo $row[OT]; ?>">
<button class="btn btn-default"><i class="glyphicon glyphicon-edit text-primary"></i></button>
</form>
<?php
}
 ?>
</td>

</tr>
<?php 
}?>
</tr>
</tbody>
</table>

</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
</div>
</div>

</div>

</div>

<!-- FIN MODAL REGISTRAR -->



</html>