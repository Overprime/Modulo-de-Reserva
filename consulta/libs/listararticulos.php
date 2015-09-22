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
<script type="text/javascript" language="javascript" src="js/jslistadoarticulos.js"></script>
<table class="table table-bordered table-condensed" id="tabla_lista_articulos">
<thead>
<tr class="success">
<th>CÓDIGO</th>
<th>DESCRIPCIÓN</th>
<th>FAMILIA</th>
<th>UNIDAD</th>
<th>STOCK ALM.</th>
<th>CANT. RESV.</th>
<th>CANT. DISP.</th>
<th>FICHA TÉCNICA</th>
<th><i class="glyphicon glyphicon-zoom-in text-primary"></i></th>
</tr>
<?php require_once('../../bd/conexion.php');
$link=  Conectarse();
$listado=  mssql_query("SELECT (ROW_NUMBER() OVER(ORDER BY ACODIGO))AS ITEM,ACODIGO,ADESCRI,AFAMILIA,AUNIDAD,STSKDIS,
	SUM(ISNULL(CANT_PEND,0))AS CANT_RESEV,
(ISNULL(STSKDIS,0)-SUM(ISNULL(CANT_PEND,0)))AS CANT_DISP,ACOMENTA 
FROM [011BDCOMUN].DBO.MAEART AS M LEFT JOIN [011BDCOMUN].DBO.STKART AS S ON
M.ACODIGO=S.STCODIGO AND STALMA='01' LEFT JOIN [020BDCOMUN].DBO.RESERVA_DET AS D ON
S.STCODIGO=D.CODIGO AND STALMA='01'
WHERE  AESTADO='V' AND AFSTOCK='S' 
GROUP BY ACODIGO,ADESCRI,AFAMILIA,AUNIDAD,ACOMENTA,STSKDIS",$link);
?>

<tbody>
<?php
while($reg=  mssql_fetch_array($listado)) 
{
?>
<tr class="active">

<td><?php echo utf8_encode($reg['ACODIGO']); ?></td>
<td><?php echo utf8_encode($reg['ADESCRI']) ?></td>
<td><?php echo utf8_encode($reg['AFAMILIA']) ?></td>
<td><?php echo utf8_encode($reg['AUNIDAD']) ?></td>
<td><?php echo utf8_encode($reg['STSKDIS']) ?></td>
<td><?php echo utf8_encode($reg['CANT_RESEV']) ?></td>
<td><?php echo utf8_encode($reg['CANT_DISP']) ?></td>
<td><?php echo utf8_encode($reg['ACOMENTA']) ?></td>
<td><a href="detalle/detalle?codigo=<?php echo utf8_encode($reg['ACODIGO']); ?>&
descripcion=<?php echo utf8_encode($reg['ADESCRI']);?> &
cantidad=<?php echo utf8_encode($reg['CANT_DISP']);?> &
total=<?php echo utf8_encode($reg['CANT_RESEV']);?>
" 
target="_black"><i class="glyphicon glyphicon-zoom-in text-primary"></i></a></td>
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



</html>