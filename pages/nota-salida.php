<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>NOTA SALIDA</title>
<?php include('../header.php'); ?>
<?php 	
//VARIABLES POST:
$NUMERO=$_REQUEST['numero'];
$OF=$_REQUEST['of'];
$V=$_REQUEST['v'];
?>
</head>
<body>
<div class="container">

<div class="row clearfix">
<div class="col-md-8 column">
<h3 class="text-primary">NOTA DE SALIDA:</h3>
<table class="table table-bordered table-condensed">
<thead>
<tr class="warning">
<th>NRO DE DOCUMENTO</th>
<th>TIPO DE MOVIMIENTO</th>
<th>DOC. DE REFERENCIA</th>
<th>O/F. DE REFERENCIA</th>
<th>O/F</th>
</tr>
</thead>
<tbody>
<?php 
$link=Conectarse();
$sql="SELECT  CANUMDOC,CACODMOV AS TIPMOV,(CARFTDOC+'-'+CARFNDOC)AS DOCREF,
case when rtrim(MC.CAORDFAB)= '' then 'PENDIENTE'
else isnull(MC.CAORDFAB , 'SIN O/F	') end ORFAB  FROM [011BDCOMUN].DBO.MOVALMCAB  as MC INNER JOIN 
[011BDCOMUN].DBO.INV_REQMATERIAL_CAB AS RMA
ON  MC.CARFNDOC=RMA.REQ_NUMERO  WHERE CATIPMOV='S' AND CATD='NS'   AND CARFTDOC='RM'
AND CASITGUI='V' AND CANUMDOC='$NUMERO'
";    
$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("EL DOCUMENTO NO EXISTE");

while($row=mssql_fetch_array($result))
{
?>
<tr class ="success">
<?php
?>
<td><?php echo $row[CANUMDOC]; ?></td>
<td><?php echo $row[TIPMOV]; ?></td>
<td><?php echo $row[DOCREF]; ?></td>
<td><?php echo $OF; ?></td>
<td><?php echo $row[ORFAB]; ?></td>



</tr>
<?php
}
?>

</tbody>
</table>

</div>

<div class="col-md-4 column">
<br> <br> <br>		

<?php 

if ($V=='SIN O/F') {
	?>
 <a id="modal-261471" href="#modal-container-261471" 
		 role="button" class="btn btn-lg btn-success" data-toggle="modal">
		 ACTUALIZAR O/F</a>

	<?php
}
else {
	

	echo " ";


}

 ?>

		
</div>
</div>

<div class="row clearfix">
<div class="col-md-12 column">
<h4 class="text-primary">DETALLE DEL DOCUMENTO:</h4>
<table class="table table-bordered table-condensed">
<thead>
<tr class="warning">
<th>ITEM</th>
<th>CODIGO</th>
<th>DESCRIPCIÓN</th>
<th>CANTIDAD</th>
<th>O/F</th>
</tr>
</thead>
<tbody>
<?php 
$link=Conectarse();
$sql="SELECT DEITEM,DECODIGO,DEDESCRI,DECANTID,
case when rtrim(DEORDFAB)= '' then 'PENDIENTE'
else isnull(DEORDFAB , 'SIN O/F	') end ORFAB  FROM 
[011BDCOMUN].DBO.MOVALMDET  WHERE DENUMDOC='$NUMERO'  AND DEALMA='01' AND
DETD='NS' AND DEESTADO='V'

";    
$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("EL DOCUMENTO NO EXISTE");

while($row=mssql_fetch_array($result))
{
?>
<tr class ="success">
<?php
?>
<td><?php echo $row[DEITEM]; ?></td>
<td><?php echo $row[DECODIGO]; ?></td>
<td><?php echo utf8_encode($row[DEDESCRI]); ?></td>
<td><?php echo $row[DECANTID]; ?></td>
<td><?php echo $row[ORFAB]; ?></td>



</tr>
<?php
}
?>

</tbody>
</table>
</div>
</div>

</div>
</body>


<!--  -->
<div class="modal fade" id="modal-container-261471" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-primary" id="myModalLabel">
Actualizar Datos
</h4>
</div>
<div class="modal-body">
Se agregara la O/F <b class="text-primary"><?php echo $OF;?></b> al documento número
 <b class="text-primary"><?php echo $NUMERO; ?></b>.
</div>
<div class="modal-footer">
 <a  href="../actualizar/nota-salida.php?documento=<?php echo $NUMERO; ?>&
 of=<?php echo $OF; ?>" 
 type="button" class="btn btn-primary">Proceder</a>   
 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
</div>

</div>

</div>


<!--  -->

</html>