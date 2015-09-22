<!DOCTYPE html>
<html lang="es">
<head>
<?php include('../header.php'); ?>
<?php $PEDIDO=$_REQUEST['pedido']; ?>
<link rel="stylesheet" type="text/css" href="../estilos/verificar-pedido.css">

</head>
<body>
<div class="container">

<div class="row clearfix">

<div class="col-md-3 column">
<form action="verificar-pedidos" method="POST">
<label><a href="" onclick="window.print();" title="IMPRIMIR">PEDIDO:</a></label>
<input type="number" name="pedido" class="form-control" min="1" value="<?php echo $PEDIDO; ?>"	
placeholder='INGRESE EL PEDIDO'>
</form>
</div>
</div>
<P>	</P>

<div class="row clearfix">

<div class="col-md-12 column">
<div class="">	

<table class="table table-bordered table-condensed">	

<thead>	
<tr>
	<th colspan="8" class="success">DETALLE DEL PEDIDO </th>

</tr>

<tr class="active">	
<th class="warning">IT</th>
<th class="warning">CODIGO</th>
<th class="warning">DESCRIPCION</th>
<th class="warning">CANT. PEDIDO</th>
<th class="warning">CANT. x ATENDER</th>
<th class="warning">CANT. DESP.</th>
<th class="warning">UBIC.</th>
<th class="warning">CANT. DISP.</th>


</tr>
</thead>
<?php 
$link=Conectarse();
$sql="SELECT DFNUMPED,DFSECUEN,DFCODIGO,DFDESCRI,DFCANTID,DFSALDO,TB.TCASILLERO,
ISNULL(SUM(RD.CANTIDAD),0)AS CANT_SOL,ISNULL(S.STSKDIS,0)-ISNULL(SUM(RD.CANT_PEND),0)AS CANT_DISP
FROM [011BDCOMUN].DBO.PEDDET AS PD
 LEFT JOIN [020BDCOMUN].DBO.RESERVA_DET AS RD ON
PD.DFCODIGO=RD.CODIGO  LEFT JOIN [011BDCOMUN].DBO.STKART AS S ON 
PD.DFCODIGO=S.STCODIGO AND STALMA='01'  LEFT JOIN [011BDCOMUN].DBO.TABCASILLERO AS TB
ON S.STCODIGO=TB.TCODART AND TCODALM='01' WHERE DFSALDO >=1 AND DFALMA='01'  AND DFCODIGO <>'TEXTO'
AND CAST(DFNUMPED AS INT)='$PEDIDO'
GROUP BY DFNUMPED,DFSECUEN,DFCODIGO,DFDESCRI,DFCANTID,DFSALDO,STSKDIS,TCASILLERO
HAVING ISNULL(S.STSKDIS,0)-ISNULL(SUM(RD.CANT_PEND),0)>=1
ORDER BY TCASILLERO ";
$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("SOLO SE MUESTRAN PEDIDOS CON CANTIDADES DISPONIBLES");
while($row=mssql_fetch_array($result))
{
?>
<tbody>	
<tr>			
<td class=""><?php echo $row[DFSECUEN]; ?></td>
<td class=""><?php echo utf8_encode($row[DFCODIGO]); ?></td>
<td class=""><?php echo utf8_encode($row[DFDESCRI]); ?></td>
<td class=""><?php echo $row[DFCANTID]; ?></td>
<td class=""><?php echo $row[DFSALDO]; ?></td>
<td></td>
<td class=""><?php echo $row[TCASILLERO]; ?></td>
<td><?php echo $row[CANT_DISP]; ?></td>



</tr>
<?php 
}?>
</tbody>








</table>		



</div>	


</div>
</div>

</div>
</body>
</html>