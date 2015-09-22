<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Document</title>
<link rel="stylesheet" type="text/css" href="/overprime/inventarios/moduloreserva/css/bootstrap.css">
</head>
<body>



<div class="row clearfix">

<div class="col-md-12 column">


<div class="table-responsive">


<table class="table table-bordered">
<thead>
<tr class="success">
<th>IT</th>
<th>CÓDIGO</th>
<th>DESCRIPCIÓN</th>
<th>FAM.</th>
<th>UND</th>
<th>C.RESV.</th>
<th>C.DISP.</th>
<th>FICHA TÉCNICA</th>
<th><i class="glyphicon glyphicon-zoom-in text-primary"></i></th>
</tr>	
</thead>
<tbody>	
<?php 
include '../bd/conexion.php';

$q=$_POST[q];
$link=Conectarse();
$sql="SELECT (ROW_NUMBER() OVER(ORDER BY ACODIGO))AS ITEM,ACODIGO,ADESCRI,AFAMILIA,AUNIDAD,STSKDIS,
	SUM(ISNULL(CANT_PEND,0))AS CANT_RESEV,
(ISNULL(STSKDIS,0)-SUM(ISNULL(CANT_PEND,0)))AS CANT_DISP,ACOMENTA 
FROM [011BDCOMUN].DBO.MAEART AS M LEFT JOIN [011BDCOMUN].DBO.STKART AS S ON
M.ACODIGO=S.STCODIGO LEFT JOIN [020BDCOMUN].DBO.RESERVA_DET AS D ON
S.STCODIGO=D.CODIGO AND STALMA='01'
WHERE  AESTADO='V' AND AFSTOCK='S' AND ACODIGO+ADESCRI+ACOMENTA LIKE '%$q%'
AND STALMA='01'
GROUP BY ACODIGO,ADESCRI,AFAMILIA,AUNIDAD,ACOMENTA,STSKDIS";

$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("NO  HAY RESULTADOS PARA SU BÚSQUEDA");

while($row=mssql_fetch_array($result))
{
	?>
<tr class="active">
<td><?php echo utf8_encode($row['ITEM']); ?></td>
<td><?php echo utf8_encode($row['ACODIGO']); ?></td>
<td><?php echo utf8_encode($row['ADESCRI']) ?></td>
<td><?php echo utf8_encode($row['AFAMILIA']) ?></td>
<td><?php echo utf8_encode($row['AUNIDAD']) ?></td>
<td><?php echo utf8_encode($row['CANT_RESEV']) ?></td>
<td><?php echo utf8_encode($row['CANT_DISP']) ?></td>
<td><?php echo utf8_encode($row['ACOMENTA']) ?></td>
<td><a href="/overprime/inventarios/moduloreserva/consulta/detalle/articulos?codigo=<?php echo utf8_encode($row['ACODIGO']); ?>&
descripcion=<?php echo utf8_encode($row['ADESCRI']);?> &
cantidad=<?php echo utf8_encode($row['CANT_DISP']);?> &
total=<?php echo utf8_encode($row['CANT_RESEV']);?>
" 
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




</body>
</html>