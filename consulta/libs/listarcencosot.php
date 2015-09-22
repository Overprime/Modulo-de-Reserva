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
</head>
<body>

<div class="container">

<div class="row clearfix">
<div class="col-md-12 column">
<a id="modal-221645" href="#modal-container-221645" 
role="button" class="btn btn-primary" data-toggle="modal">REGISTRAR</a>
</div>
</div>
<p>  <!-- LINEA DE SEPARACION ENTRE BOTON Y TABLA -->  </p>


<div class="row clearfix">

<div class="col-md-12 column">

<div class="table-responsive">


<script type="text/javascript" language="javascript" src="js/jslistadocencosot.js"></script>

<table class="table table-bordered table-condensed" id="tabla_lista_cencosot">
<thead>
<tr class="success">
<th>ID</th>
<th>O/T</th>
<th>CENTRO DE COSTO</th>
<th>DESCRIPCIÓN</th>
<th>HORA</th>
<th>FECHA DE CREACIÓN</th>
<th>CREADOR</th>


<?php 


if ($IDUSUARIO==2) {
	echo "<th class='disabled'>&nbsp;&nbsp;&nbsp;";
	echo "<i class='glyphicon glyphicon-trash text-danger'></i></td>";
	echo "</th>";
}

else

{echo "";}



 ?>



</tr>
<?php require_once('../../bd/conexion.php');
$link=  Conectarse();
$listado=  mssql_query("SELECT (ROW_NUMBER() OVER(ORDER BY IDCENCOSOT))AS ITEM,
IDCENCOSOT,CODIGOCENTROCOSTO,CENCOST_DESCRIPCION,
CODIGOOT,CONVERT(VARCHAR,FECHA,103) as FECHAS,HORA,(U.nombres+' '+U.apellidos )AS FULLNAME
FROM [020BDCOMUN].DBO.CENCOSOT AS CC INNER JOIN 
[011BDCONTABILIDAD].DBO.CENTRO_COSTOS AS CCC ON 
CC.CODIGOCENTROCOSTO=CCC.CENCOST_CODIGO INNER JOIN [020BDCOMUN].DBO.USUARIOS AS U
ON CC.USUARIO=U.id_usuario 
WHERE  CODIGOOT IN (SELECT OF_COD FROM [011BDCOMUN].dbo.ORD_FAB
WHERE OF_ESTADO ='ACTIVO')  ORDER BY CENCOST_DESCRIPCION
 ",$link);
?>

<tbody>
<?php
while($reg=  mssql_fetch_array($listado)) 
{
?>
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
<td><?php echo utf8_encode($reg[ITEM]); ?></td>
<td><?php echo utf8_encode($reg[CODIGOOT]); ?></td>
<td><?php echo utf8_encode($reg[CODIGOCENTROCOSTO]); ?></td>
<td><?php echo utf8_encode($reg[CENCOST_DESCRIPCION]); ?></td>
<td><?php echo $reg[HORA]; ?></td>
<td><?php echo utf8_encode($reg[FECHAS]); ?></td>
<td><?php echo utf8_encode($reg[FULLNAME]); ?></td>

<?php 
if ($IDUSUARIO==2) {?>
<td>	
<a id="modal-834176" href='<?php echo $txtx;?>' 
role="button" class="btn" data-toggle="modal"><i class="glyphicon glyphicon-trash text-danger"></i></a>
</td>

	<?php
}

else

{echo " ";}

 ?>





<!--  INICIO MODAL ELIMINAR CODIGO-->


<div class="modal fade" id="<?php echo $txt;?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-danger" id="myModalLabel">
ELIMINACIÓN DE CODIGOS
</h4>
</div>
<div class="modal-body">


¿Desea eliminar la O/T <b><?php echo $reg[CODIGOOT]; ?></b> asociada al centro de costo
 <b><?php echo $reg[CODIGOCENTROCOSTO]; ?> /<?php echo $reg[CENCOST_DESCRIPCION]; ?>  </b>    ? 


</div>
<div class="modal-footer">
 <a href="../eliminar/cencosot.php?id=<?php echo $reg[IDCENCOSOT]; ?>" class="btn btn-danger">SI</a>
<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>

</div>
</div>

</div>

</div>
<!--  FIN eliminar ACTUALIZAR CODIGO-->


</tr>
<?php
$i=$i+1;
$j=$j+1; 
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
ASOCIAR OT & CENTRO DE COSTO
</h4>
</div>
<form action="../registrar/asociacion-centrocosto-ot.php" method="POST">
<div class="modal-body">
<label for="">OT:</label>
<select name="ot" class="form-control" required>
<option value="">SELECCIONAR...</option>
<?php
$link=Conectarse();
$Sql ="SELECT OF_COD,OF_ARTNOM,OF_ESTADO FROM [011BDCOMUN].dbo.ORD_FAB
WHERE OF_ESTADO ='ACTIVO'  AND 
OF_COD NOT IN (SELECT CODIGOOT FROM [020BDCOMUN].DBO.CENCOSOT)
ORDER BY OF_COD";

//OF_COD NOT IN (SELECT CODIGOOT FROM [020BDCOMUN].DBO.CENCOSOT) ORDER BY OF_COD
$result=mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option value="<?php echo $row['OF_COD']?>"><?php echo $row['OF_COD']?></option>
<?php }?>
</select>
<label for="">CENTRO DE COSTO:</label>
<select name="centrodecosto" class="form-control" required>
<option value="">SELECCIONAR...</option>
<?php
$link=Conectarse();
$Sql ="SELECT  CENCOST_CODIGO,CENCOST_DESCRIPCION,
(CENCOST_DESCRIPCION+' - '+CENCOST_CODIGO)as fullname
from [011BDCONTABILIDAD].DBO.CENTRO_COSTOS 
ORDER BY CENCOST_DESCRIPCION";

$result=mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option class="text-primary" value="<?php echo $row['CENCOST_CODIGO']?>">
<?php echo utf8_encode($row['CENCOST_DESCRIPCION']).' --> '.$row['CENCOST_CODIGO']?></option>
<?php }?>
</select>
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