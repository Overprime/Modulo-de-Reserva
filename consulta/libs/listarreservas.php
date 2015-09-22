<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<?php
//VARIABLES DE SESION 
session_start();
$IDUSUARIO=$_SESSION['id_usuario'];	
$COD_SOLICITANTE=$_SESSION['starsoft'];
$IDEMPRESA=$_SESSION['idempresa'];
$IDAREA=$_SESSION['idarea'];
$AUD_JEFE=$_SESSION['aud_jefe'];
?>
</head>
<body>

<div class="container">
<div class="row clearfix">
<div class="col-md-3 column">

<?php if ($IDUSUARIO==18 || $IDUSUARIO==9 || $IDUSUARIO==3)
 {	echo "";} 
else
	{echo "<a id='modal-221645' href='#modal-container-221645' 
role='button' class='btn btn-success' data-toggle='modal'>REGISTRAR RESERVA C.C-O/T</a>";}
?>

</div>


<div class="col-md-4 column">
<?php if ($IDUSUARIO==18 || $IDUSUARIO==9 || $IDUSUARIO==3)
 {	echo "";} 
else
	{echo "<a id='modal-221646' href='#modal-container-221646' 
role='button' class='btn btn-primary' data-toggle='modal'>REGISTRAR RESERVA C.C</a>";}
?>



</div>
</div>




<p>  <!-- LINEA DE SEPARACION ENTRE BOTON Y TABLA -->  </p>


<div class="row clearfix">

<div class="col-md-12 column">

<div class="table-responsive">


<script type="text/javascript" language="javascript" src="js/jslistadoreservas.js"></script>

<table class="table table-bordered table-condensed" id="tabla_lista_reservas">
<thead>
<tr class="success">
<th width="20" >NRO. RESERVA</th>
<th width="100" >SOLICITANTE</th>
<th width="20" style="text-align: center">OT</th>
<th width="20" style="text-align: center">CENTRO COSTO</th>
<th width="20" style="text-align: center">FECHA DE CREACIÓN</th>
<th width="20" style="text-align: center">HORA DE CREACIÓN</th>
<th width="40" style="text-align: center">PROCESO</th>
</tr>
<?php require_once('../../bd/conexion.php');
$link=  Conectarse();
$listado=  mssql_query("SELECT CRV.NRORESERVA,CRV.OT,T.TDESCRI,
	CRV.USUARIO,T.TCLAVE,CRV.IDAREA,CONVERT(VARCHAR,CRV.FECHA,101)AS FECHA,
	CONVERT(VARCHAR,CRV.FECHA,108) AS HORA,
CRV.CENTROCOSTO ,CRV.TIPO FROM
 [020BDCOMUN].DBO.RESERVA_CAB AS CRV
INNER JOIN [011BDCOMUN].DBO.TABAYU AS T ON CRV.SOLICITANTE=T.TCLAVE WHERE TCOD='12' AND 
CRV.ESTADO='00' /*AND CRV.USUARIO='$IDUSUARIO'*/
ORDER BY CRV.NRORESERVA DESC ",$link);
?>

<tbody>
<?php
while($reg=  mssql_fetch_array($listado)) 
{
?>
<tr class="active">

<td ><?php echo utf8_encode($reg[NRORESERVA]); ?></td>
<td ><?php echo utf8_encode($reg[TDESCRI]); ?></td>
<td style="text-align: center"><?php echo utf8_encode($reg[OT]); ?></td>
<td style="text-align: center"><?php echo utf8_encode($reg[CENTROCOSTO]); ?></td>
<td style="text-align: center"><?php echo utf8_encode($reg[FECHA]); ?></td>
<td style="text-align: center"><?php echo utf8_encode($reg[HORA]); ?></td>
<td style="text-align: center"><?php 	
if ($IDUSUARIO==$reg[USUARIO] ) {
echo "
<form action='../pages/editar-reserva' method='POST'>
<input type='hidden' name='reserva' value='$reg[NRORESERVA]'>
<input type='hidden' name='tipo' value='$reg[TIPO]'>
<input type='hidden' name='otcc' value='$reg[OT]'>
<input type='hidden' name='cc' value='$reg[CENTROCOSTO]'>
<button class='btn btn-default' title='EDITAR'><i class='glyphicon glyphicon-edit text-primary'></i></button>
</form>
";

}

else if ($IDUSUARIO=='3' && $IDEMPRESA='2') {
echo "
<form action='../pages/editar-reserva-almacen' method='POST'>
<input type='hidden' name='reserva' value='$reg[NRORESERVA]'>
<input type='hidden' name='tipo' value='$reg[TIPO]'>
<input type='hidden' name='otcc' value='$reg[OT]'>
<input type='hidden' name='cc' value='$reg[CENTROCOSTO]'>
<button class='btn btn-default' title='EDITAR'><i class='glyphicon glyphicon-edit text-primary'></i></button>
</form>
";
}

else if ($IDUSUARIO=='18' && $IDEMPRESA='2'&& $IDAREA==$reg[IDAREA]) {
echo "
<form action='../pages/editar-reserva-servicios' method='POST'>
<input type='hidden' name='reserva' value='$reg[NRORESERVA]'>
<input type='hidden' name='tipo' value='$reg[TIPO]'>
<input type='hidden' name='otcc' value='$reg[OT]'>
<input type='hidden' name='cc' value='$reg[CENTROCOSTO]'>
<button class='btn btn-default' title='EDITAR'><i class='glyphicon glyphicon-edit text-primary'></i></button>

</form>
";
}

else if ($IDUSUARIO=='9' && $IDEMPRESA='2'&& $IDAREA==$reg[IDAREA]) {
echo "
<form action='../pages/editar-reserva-fabricacion' method='POST'>
<input type='hidden' name='reserva' value='$reg[NRORESERVA]'>
<input type='hidden' name='reserva' value='$reg[NRORESERVA]'>
<input type='hidden' name='tipo' value='$reg[TIPO]'>
<input type='hidden' name='otcc' value='$reg[OT]'>
<input type='hidden' name='cc' value='$reg[CENTROCOSTO]'>
<button class='btn btn-default' title='EDITAR'><i class='glyphicon glyphicon-edit text-primary'></i></button>
</form>
";
}
else if ($reg[USUARIO]==18) {
echo "ok";
}


else {

echo "
<form action='../pages/consultar-reservas' method='POST'>
<input type='hidden' name='reserva' value='$reg[NRORESERVA]'>
<input type='hidden' name='reserva' value='$reg[NRORESERVA]'>
<input type='hidden' name='tipo' value='$reg[TIPO]'>
<input type='hidden' name='otcc' value='$reg[OT]'>
<input type='hidden' name='cc' value='$reg[CENTROCOSTO]'>
<button class='btn btn-default' title='CONSULTAR'><i class='glyphicon glyphicon-edit text-danger'></i></button>
</form>
";
}


?></td>










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
$sql="SELECT TOP 1 NRORESERVA  FROM [020BDCOMUN].DBO.RESERVA_CAB
ORDER BY NRORESERVA DESC ";
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
<!-- INICIO MODAL REGISTRAR OT/CC -->
<div class="modal fade" id="modal-container-221645" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-primary" id="myModalLabel">
CREAR RESERVA OT/CC
</h4>
</div>
<form action="../registrar/crear-reserva.php" method="POST">
<div class="modal-body">
<label for="">NÚMERO DE RESERVA:</label>
<input type="hidden" value='ot-cc' name="tipo">
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

<!-- FIN MODAL REGISTRAR CC/OT-->






<!-- INICIO MODAL REGISTRAR CC-->
<div class="modal fade" id="modal-container-221646" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-primary" id="myModalLabel">
CREAR RESERVA CENTRO DE COSTO
</h4>
</div>
<form action="../registrar/crear-reserva.php" method="POST">
<div class="modal-body">
<input type="hidden" value='cc' name="tipo">
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
<label for="">CENTRO DE COSTO:</label>
<select name="cencos" class="form-control" required>
<option value="">SELEECCIONE EL CC...</option>
<?php
$link                      =Conectarse();
$Sql                       ="SELECT  CENCOST_CODIGO,CENCOST_DESCRIPCION,
(CENCOST_DESCRIPCION+' - '+CENCOST_CODIGO)as fullname
from [015BDCONTABILIDAD].DBO.CENTRO_COSTOS

order by  CENCOST_DESCRIPCION";
$result                    =mssql_query($Sql) or die(mssql_error());
while ($row                =mssql_fetch_array($result)) {
?>
<option value              ="<?php echo $row['CENCOST_CODIGO']?>">
<?php echo utf8_encode($row['fullname']);?></option>
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

<!-- FIN MODAL REGISTRAR CC -->




</html>