<!DOCTYPE html>
<html lang="es">
<head>
<?php include('../../header.php'); ?>
<?php //VARIABLE DE SESION:
$IDUSUARIO=$_SESSION['id_usuario'];

?>

</head>
<body>
<div class="container">

<div class="row clearfix">
<form action="../../registrar/requerimiento-excel.php" method="POST">
<div class="col-md-3 column">
<input type="hidden" name='usuario' value="<?php echo $IDUSUARIO; ?>">
<input type="hidden" name="tipo" value="CC">
<label>RESERVA:</label>
<select name="numeroreserva" class="form-control" required>
<option value="">Seleccione la reserva...</option>
<?php
$link=Conectarse();
$Sql="SELECT C.NRORESERVA,C.OT,C.USUARIO,C.CENTROCOSTO,C.TIPO FROM [020BDCOMUN].DBO.RESERVA_CAB AS C
WHERE C.ESTADO='00' AND C.USUARIO='$IDUSUARIO' AND C.TIPO='cc'
AND C.NRORESERVA NOT IN (SELECT D.NRORESERVA FROM [020BDCOMUN].DBO.RESERVA_DET AS D)
ORDER BY C.NRORESERVA";
$result       =mssql_query($Sql) or die(mssql_error());
while ($row   =mssql_fetch_array($result)) {
?>
<option value ="<?php echo $row['NRORESERVA']?>"><?php echo $row['NRORESERVA'].'--->'.$row['OT'].$row['CENTROCOSTO']?>
</option>
<?php }?>
</select>
</div>
<div class="col-md-3 column">
<!-- 
<a href="/overprime/inventarios/moduloreserva/actualizar/actualizar-stock.php" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i></a> -->
</div>
<div class="col-md-4 column">

</div>
<div class="col-md-2 column">
<!-- Single button -->
<div class="btn-group">
<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
Procesos <span class="caret"></span>
</button>
<ul class="dropdown-menu" role="menu">
<li><a id="modal-491438" href="#modal-container-491438" role="button"  data-toggle="modal"><i class="glyphicon glyphicon-cloud-upload text-success" ></i>
<label class="text-success">Subir Datos</label></a></li>
<!--  
<li class="divider"></li>
<li><a href="verificacion"><i class="glyphicon glyphicon-new-window text-primary" ></i>
<label class="text-primary">Verificar Codigos</label></a></li>-->

<li class="divider"></li>
<li><a d="modal-964459" href="#modal-container-964459" role="button" class="btn" data-toggle="modal"><i class="glyphicon glyphicon-trash text-danger" ></i>
<label class="text-danger">Liberar Datos</label></a></li>
</ul>
</div>
</div>
</div>

<!--  -->
<!-- INCIO MODAL SUBIR DATOS -->
<div class="modal fade" id="modal-container-491438" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title" id="myModalLabel">
Carga de Datos
</h4>
</div>
<div class="modal-body">
¿<b>Está seguro</b> de subir la informacion al documento seleccionado,tenga en cuenta
que solo se subiran los articulos verificados con el icono 
<i class="glyphicon glyphicon-ok-circle text-primary"></i>  ?
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Estoy Seguro</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 

</div>
</div>

</div>

</div>

<!-- INCIO MODAL SUBIR DATOS -->
</form>
<p></p>
<!--  -->
<div class="row clearfix">

<div class="col-md-12 column">
<div class="table-responsive">

<table class="table table-condensed table-bordered">
<thead>
<tr class="success">
<th>IT</th>
<th>CÓDIGO</th>
<th>DESCRIPCIÓN</th>
<th>UND</th>
<th>CANT. SOL.</th>
<th>CANT. RESV.</th>
<th>CANT. DISP.</th>
<th style="text-align: center"><i class="glyphicon glyphicon-edit text-primary"></i></th>
<th style="text-align: center"><i class="glyphicon glyphicon-trash text-danger"></i></th>
<th style="text-align: center"><i class="glyphicon glyphicon-eye-open "></i></th>
</tr>
</thead>
<?php 
$link=Conectarse();
$sql="SELECT (ROW_NUMBER() OVER(ORDER BY ISNULL(S.STSKDIS,0)-SUM(ISNULL(D.CANT_PEND,0)) DESC))AS
 ITEM,
DRV.CODIGO,M.ADESCRI,DRV.CANTIDAD,DRV.TIPO,M.AUNIDAD,SUM(ISNULL(D.CANT_PEND,0)) AS CANT_RESERV,
ISNULL(S.STSKDIS,0)-SUM(ISNULL(D.CANT_PEND,0)) AS CANT_DISP
FROM [020BDCOMUN].DBO.DATOS_RSV AS DRV LEFT JOIN 
[020BDCOMUN].DBO.RESERVA_DET AS D ON 
DRV.CODIGO=D.CODIGO LEFT JOIN [011BDCOMUN].DBO.STKART AS S ON 
DRV.CODIGO=S.STCODIGO AND STALMA='01' 
LEFT JOIN [011BDCOMUN].DBO.MAEART AS M ON
DRV.CODIGO=M.ACODIGO  WHERE USUARIO='$IDUSUARIO' 
AND DRV.TIPO='CC'  AND M.AFSTOCK='S' AND 
 STALMA='01' AND AESTADO='V'
GROUP BY DRV.CODIGO,M.ADESCRI,DRV.CANTIDAD,DRV.TIPO,M.AUNIDAD,S.STSKDIS
";
$result                    = mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result) ==0) die("NO HAY REGISTROS PARA MOSTRAR");
while($row                 =mssql_fetch_array($result))
{
?>

<tbody>
<tr class="active">
<?php 	
$txta                      ='modal-containera-';
$txtxa                     ='#modal-containera-';
$txta                      .=$j;
$txtxa                     =$txtxa.=$j;

$txt                       ='modal-container-';
$txtx                      ='#modal-container-';
$txt                       .=$i;
$txtx                      =$txtx.=$i;
?>
<td><?php echo $row[ITEM]; ?>  </td>
<td><?php echo utf8_encode($row[CODIGO]); ?>  </td>
<td><?php 	
if ($row[ADESCRI]=='') {
echo "<label class='text-danger'>EL CÓDIGO NO EXISTE O ESTA MAL ESCRITO.......VERIFICAR!!!!!!</label>";
}
else {
echo utf8_encode($row[ADESCRI]);
}
?>	
</td>
<td><?php echo $row[AUNIDAD]; ?>  </td>
<td><?php echo $row[CANTIDAD]; ?>  </td>
<td><?php echo $row[CANT_RESERV]; ?>  </td>
<td><label class="text-danger"></label>
<?php 	
$numero=-189;

if ($row[CANT_DISP]==0) {echo "<label class='text-danger'>0</label>";}

else if ($row[CANT_DISP]<1) {echo "<label class='text-danger'>ACTUALIZAR STOCK</label>";}

else{echo $row[CANT_DISP];}


 ?>


</td>
<td style="text-align: center">	
<a id="modal-834176" href='<?php echo $txtxa;?>' 
role="button" class="btn" data-toggle="modal"><i class="glyphicon glyphicon-edit text-primary"></i></a>
</td>
<td style="text-align: center">	
<a id="modal-834176" href='<?php echo $txtx;?>' 
role="button" class="btn" data-toggle="modal"><i class="glyphicon glyphicon-trash text-danger"></i></a>
</td>
<td style="text-align: center">		
<?php 	
if ($row[CANT_DISP]>=$row[CANTIDAD]) {
echo "<i class='glyphicon glyphicon-ok-circle text-primary'></i>";
}
else if ($row[CANT_DISP]<$row[CANTIDAD]&& $row[CANT_DISP<>0])
{echo "<i class='glyphicon glyphicon-remove-circle text-danger'></i>";}

else 
{echo "no";}
?>
</td>

<!--  INICIO MODAL ACTUALIZAR CANTIDAD-->


<div class="modal fade" id="<?php echo $txta;?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title" id="myModalLabel">
ACTUALIZACIÓN DE CÓDIGOS Y CANTIDADES
</h4>
</div>
<div class="modal-body">
<form action="../../actualizar/detalles-carga-excel.php" method="POST">

<div class="form-group">
	<label>CÓDIGO ACTUAL:</label>
	<input type="text" name="codigoactual" class="form-control" value="<?php echo $row[CODIGO]; ?>" readonly>
</div>
<div class="form-group">
	<label>CÓDIGO NUEVO:</label>
	<input type="text" name="codigonuevo" class="form-control" value="<?php echo $row[CODIGO]; ?>">
</div>
<div class="form-group">
	<label>DESCRIPCIÓN:</label>
	<input type="text" name="descripcion" class="form-control" value="<?php echo $row[ADESCRI]; ?>" readonly>
</div>
<div class="form-group">
	<label>CANTIDAD ACTUAL:</label>
	<input type="text" name="cantidadactual" class="form-control" value="<?php echo $row[CANTIDAD]; ?>" readonly>
</div>
<div class="form-group">
	<label>CANTIDAD NUEVA:</label>
	<input type="number" name="cantidadnueva" min="1" max="<?php echo $row[CANT_DISP]; ?>" class="form-control" value="<?php echo $row[CANTIDAD]; ?>" autofocus>
</div>
<input type="hidden"  name="tipo"value="<?php echo $row[TIPO]; ?>">
</div>
<div class="modal-footer">
 <button type="submit" class="btn btn-primary">Actualizar</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</form>
</div>
</div>

</div>

</div>
<!--  FIN MODAL ACTUALIZAR CANTIDAD-->

<!--  INICIO MODAL ELIMINAR CODIGO-->


<div class="modal fade" id="<?php echo $txt;?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-center text-danger" id="myModalLabel">
ELIMINACIÓN DE CODIGOS
</h4>
</div>
<div class="modal-body">


¿Desea eliminar el código  <label class="text-danger" ><b><?php echo $row[CODIGO]; ?></b></label>
de cantidad <label class="text-primary" ><b><?php echo $row[CANTIDAD]; ?></b></label>   ? 


</div>
<div class="modal-footer">
 <a href="../../eliminar/detalles-carga-excel.php?codigo=<?php echo $row[CODIGO];?>&
 usuario=<?php echo $IDUSUARIO;?>&tipo=<?php echo $row[TIPO];?>" class="btn btn-danger">Eliminar</a>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

</div>
</div>

</div>

</div>
<!--  FIN eliminar ACTUALIZAR CODIGO-->

</tr>
<?php
$i                         =$i+1;
$j                         =$j+1;  
}?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</body>

<!-- INCIO MODAL LIBERAR DATOS-->
<div class="modal fade" id="modal-container-964459" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title" id="myModalLabel">
LIBERAR DATOS.
</h4>
</div>
<div class="modal-body">
¿Desea liberar los articulos que ha cargado desde el documento excel?
</div>
<div class="modal-footer">
<a href="../../eliminar/liberar-data-excel.php" type="button" class="btn btn-danger">Liberar</a>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 

</div>
</div>

</div>

</div>

<!-- INCIO MODAL LIBERAR DATOS-->


</html>