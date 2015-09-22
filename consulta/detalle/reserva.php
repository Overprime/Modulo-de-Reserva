<!DOCTYPE html>
<html lang="en">
<head>
<?php  include('../../header.php'); 
?>

<?php 
/*VARIABLES POST*/
$Numeroreserva=$_REQUEST['id'];
$Solicitante=$_REQUEST['solicitante'];
$Ot=$_REQUEST['ot'];
$Estado=$_REQUEST['estado'];
 ?>
</head>
<body>

<div class="container">
<div class="row clearfix">
<div class="col-md-2 column">
<label for="">NRO. RESERVA</label>
<input type="text" class="form-control" value="<?php echo $Numeroreserva; ?>" readonly>
</div>
<div class="col-md-4 column">
<label for="">SOLICITANTE</label>
<input type="text" class="form-control" value="<?php echo $Solicitante; ?>" readonly>
</div>
<div class="col-md-2 column">
<label for="">OT / CC :</label>
<input type="text" class="form-control" value="<?php echo $Ot ?>" readonly>
</div>
<div class="col-md-2 column">
<label for="">ESTADO:</label>
<input type="text" class="form-control" value="<?php echo $Estado ?>" readonly>
</div>
</div>


<div class="row clearfix">
<br>	
<div class="col-md-12 column">
<div class="table-responsive">
<table class="table table-bordered table-condensed">
<thead>
<tr class="active">
<th>ITEM</th>
<th>CÓDIGO</th>
<th>DESCRIPCIÓN</th>
<th>CANTIDAD</th>
<th>UNIDAD</th>
<th>FAMILIA</th>
</tr>
</thead>
<tbody>
<?php
$link=Conectarse();
$sql="SELECT (ROW_NUMBER() OVER(ORDER BY D.CODIGO))AS ITEM,D.NRORESERVA,D.CODIGO,M.ADESCRI,D.CANTIDAD,M.AUNIDAD,M.AFAMILIA
 FROM [020BDCOMUN].DBO.RESERVA_DET AS D  INNER JOIN 
[011BDCOMUN].DBO.MAEART AS M ON D.CODIGO=M.ACODIGO WHERE D.NRORESERVA='$Numeroreserva'";    
$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("No hay registros para mostrar");
while ($filas=mssql_fetch_array($result))
{
?>
<tr class="success">
<td><?php echo utf8_encode($filas['ITEM']) ?></td>
<td><?php echo utf8_encode($filas['CODIGO']) ?></td>
<td><?php echo utf8_encode($filas['ADESCRI']) ?></td>
<td><?php echo utf8_encode($filas['CANTIDAD']) ?></td>
<td><?php echo utf8_encode($filas['AUNIDAD']) ?></td>
<td><?php echo utf8_encode($filas['AFAMILIA']); ?></td>
</tr>

<?php
}
?>
<tbody>



</table>
</div>
</div>
</div>

</div>

</body>
</html>