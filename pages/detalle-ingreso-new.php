<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>DETALLE POR NOTA DE INGRESO</title>
<?php include('../header.php'); ?>
<?php 	
session_start();
$IDUSUARIO=$_SESSION['id_usuario'];	
$DOCUMENTO=$_REQUEST['documento'];
$CODSOLICITANTE=$_SESSION['starsoft'];
$OT=$_REQUEST['ot'];
$CC=$_REQUEST['cc'];
$IDAUD=$_REQUEST['id'];
$SOLICITANTE=$_REQUEST['os'];
$NOMSOLICITANTE=$_REQUEST['nomsol'];
$FECHA=$_REQUEST['fecha'];
?>

</head>
<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-3 column">
<div class="form-group">
<label for="">SOLICITANTE:</label>
<input type="text" class="form-control text-success" value="<?php echo $NOMSOLICITANTE;?>" readonly />
</div>
<div class="form-group">
<label for="">NRO. DE DOCUMENTO:</label>
<input type="text" class="form-control" value="<?php echo $DOCUMENTO;?>" readonly />
</div>
<div class="form-group">
<label for="">OT /	 CENTRO DE COSTO:</label>
<input type="text" class="form-control" value="<?php echo $OT.$CC;?>" readonly />
</div>
</div>
<div class="col-md-9 column">



<label class="text-primary">DETALLE DEL DOCUMENTO</label>




<table class="table table-bordered table-condensed">
<thead>
<tr class="success">
<th>IT</th>
<th>CÓDIGO</th>
<th>DESCRIPCIÓN</th>
<th>CANT. NI.</th>
<th>UND</th>
<th>CANT. DISP</th>
</tr>
</thead>
<?php 	

$link=Conectarse();
$sql="SELECT  D.DENUMDOC,D.DECODIGO,M.ADESCRI,D.DECANTID,D.DEUNIDAD,D.DEITEM,S.STSKDIS,
(ISNULL(S.STSKDIS,0))-ISNULL(SUM(RD.CANT_PEND),0) AS CANT_DISP FROM
[011BDCOMUN].dbo.MOVALMDET AS  D INNER JOIN [011BDCOMUN].dbo.MAEART AS M ON
D.DECODIGO=M.ACODIGO  LEFT JOIN [020BDCOMUN].DBO.RESERVA_DET AS RD ON
D.DECODIGO=RD.CODIGO LEFT JOIN [020BDCOMUN].DBO.RESERVA_CAB AS RC ON
RD.NRORESERVA=RC.NRORESERVA INNER JOIN [011BDCOMUN].DBO.STKART AS S ON
D.DECODIGO=S.STCODIGO AND STALMA='01' WHERE DENUMDOC='$DOCUMENTO' AND DETD='NI'  
/*AND RC.USUARIO='$IDUSUARIO'*/
GROUP BY D.DENUMDOC,D.DECODIGO,M.ADESCRI,D.DECANTID,S.STSKDIS,D.DEUNIDAD,D.DEITEM
ORDER BY D.DEITEM";  
$result= mssql_query($sql) or die(mssql_error());
?>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label class="text-danger">
<?php if(mssql_num_rows($result)==0) die("ACCESO DENEGADO"); ?>
</label>
<?php
//variables contador:
$a=0;
$b=0;
while($row=mssql_fetch_array($result))
{
?>
<tbody>
<tr>
<td> <?php echo $row[DEITEM]; ?>  </td>
<td> <?php echo $row[DECODIGO] ; ?> </td>
<td> <?php echo utf8_encode($row[ADESCRI]); ?>  </td>
<td> <?php echo $row[DECANTID] ; ?> </td>
<td> <?php echo $row[DEUNIDAD]; ?> </td>
<td> <?php echo $row[STSKDIS]; ?> </td>
<?php 

//$a=$a+$row[DECANTID];
//$b=$b+$row[CANT_DISP];
?>
</tr>
<?php 
}?>
</tbody>
</table>
</div>
</div>
<div class="row clearfix">
<div class="col-md-3 column">
<form action="../registrar/detalle-nota-ingreso.php" method="POST">
<input type="hidden" name="documento" value="<?php echo $DOCUMENTO; ?>">
<input type="hidden" name="idaud" value="<?php echo $IDAUD; ?>">
<div class="form-group">
<label>RESERVA</label>
<select name="reserva" class="form-control" required>
<option value="">SELECCIONE LA RESERVA...</option>
<?php
$link=Conectarse();
$Sql ="SELECT C.NRORESERVA,(T.TDESCRI) AS DESCRI ,C.OT,C.CENTROCOSTO from [020BDCOMUN].DBO.RESERVA_CAB AS C
INNER JOIN [011BDCOMUN].DBO.TABAYU AS T ON
C.SOLICITANTE=T.TCLAVE WHERE   T.TCOD=12  AND  C.USUARIO='$IDUSUARIO' AND
ESTADO='00'  AND C.OT='$OT'AND C.NRORESERVA NOT IN 
(SELECT NRORESERVA FROM [020BDCOMUN].DBO.RESERVA_DET) 
ORDER BY  C.NRORESERVA";
$result=mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option    value="<?php echo $row['NRORESERVA']?>">
<?php echo $row['NRORESERVA'].'-->'.$row['DESCRI'].'-->'.$row['OT'].$row['CENTROCOSTO']?></option>
<?php }?>

</select>
</div>

<!-- VALIDACION DE BOTON -->
<?php 
if ($a<=$b && $SOLICITANTE==$CODSOLICITANTE ) {
?>
<a id="modal-713112" href="#modal-container-713112" role="button"
class="btn btn-lg btn-primary btn-block" data-toggle="modal">TRANSFERIR</a>
<?php
}else {echo "<a class='btn btn-danger btn-lg btn-block'>ERROR</a>";}


?>







<div class="modal fade" id="modal-container-713112" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-primary text-center" id="myModalLabel">
CONFIRMAR TRANSFERENCIA.
</h4>
</div>
<div class="modal-body">
¿ESTA SEGURO DE TRANSFERIR LOS DETALLES DEL DOCUMENTO <b><?php echo  $DOCUMENTO; ?></b>
A LA RESERVA QUE HA SELECCIONADO?
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Transferir</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 

</div>
</div>

</div>

</div>

</form>
</div>
<div class="col-md-9 column">
</div>
</div>
</div>
</body>
</html>