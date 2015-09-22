<!DOCTYPE html>
<html lang="es">
<head>
<?php include('../header.php'); ?>
<?php 
//ATRIBUTOS DE SESION
$Starsoft=$_SESSION['starsoft'];
$Usuariosesion=$_SESSION['id_usuario'];?>
<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/ajaxcc.js"></script>
<script language="javascript">
$(document).ready(function() {
$(".botonExcel").click(function(event) {
$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
$("#FormularioExportacion").submit();
});
});
</script>
<style type="text/css">
.botonExcel{cursor:pointer;}

.tamano{
  font-size: 40px;
}
</style>
</head>
<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-4 column">
<form action="../registrar/crear-requerimiento.php" method="POST" autocomplete="Off">
<input type="hidden" name="usuario" value="<?php echo $Usuariosesion; ?>">
<input type="hidden" name="solicitante" value="<?php echo $Starsoft; ?>">
<label for="">REQUERIMIENTO:</label>
<select name="requerimiento" class="form-control" required>
<option value="">SELECCIONE EL REQUERIMIENTO:</option>
<?php
$link=Conectarse();
$Sql ="SELECT C.NROREQUI,C.CODSOLIC FROM [011BDCOMUN].DBO.REQUISC 
AS C INNER JOIN [011BDCOMUN].DBO.REQUISD AS D 
ON  C.NROREQUI=D.NROREQUI WHERE DESCPRO='RESERVA' AND codpro='TEXTO' 
AND CODSOLIC='$Starsoft'
order by NROREQUI";
$result                    =mssql_query($Sql) or die(mssql_error());
while ($row                =mssql_fetch_array($result)) {
?>
<option value              ="<?php echo $row['NROREQUI']?>">
<?php echo $row['NROREQUI'];?></option>
<?php }?>
</select>
<label for="">NRO. DE MAQUINA:</label>
<input type="text" name="maquina" class="form-control" required 
onchange="conMayusculas(this);">
</div>
<div class="col-md-4 column">
<label for="">ORDEN DE FABRICACIÓN:</label>
<select id="cont" name="orden" class="form-control" title='SELECCIONE EL TIPO' onchange="load(this.value)" required> 
<option value="">SELECCIONE</option>
<?php
$link=Conectarse();
$Sql="SELECT  CODIGOCENTROCOSTO,CODIGOOT FROM [020BDCOMUN].DBO.CENCOSOT
WHERE  CODIGOOT IN 
(SELECT  OF_COD FROM  [011BDCOMUN].dbo.ORD_FAB   WHERE  OF_ESTADO='ACTIVO')
ORDER BY CODIGOOT";
$result=mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option value="<?php echo $row['CODIGOOT']?>">
<?php echo $row['CODIGOOT'];?></option>
<?php }?>
</select>

<div id="myDiv"></div>
</div>
<div class="col-md-4 column">
<div class="row clearfix">
<div class="col-md-12 column">
<br>	
<a id="modal-542224" href="#modal-container-542224" role="button"
class="btn btn-lg btn-primary btn-block"  data-toggle="modal">GRABAR REQUERIMIENTO</a>
<div class="modal fade" id="modal-container-542224" role="dialog" aria-labelledby="myModalLabel" 
aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-primary text-center" id="myModalLabel">
COMFIRMACIÓN
</h4>
</div>
<div class="modal-body">
¿Esta seguro de grabar los articulos de este documento,en el Requerimiento 
de compra seleccionado?
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Si estoy seguro</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

</form>
</div>
</div>

</div>

</div>

</div>
</div>
<div class="row clearfix">
<div class="col-md-12 column">
<br>	
<a id="modal-449362" href="#modal-container-449362"
role="button" class="btn btn-lg btn-danger btn-block" data-toggle="modal">LIBERAR DATOS</a>
<br>
<form action="reporte-excel.php" method="post" target="_blank" id="FormularioExportacion">
<button class="btn btn-block btn-lg btn-success botonExcel" title="DESCARGAR" id="#excel">DESCARGAR EXCEL</button>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>

</div>
</div>
</div>
</div>

<div class="row clearfix">
<div class="col-md-12 column">
<br>	
<div class="table-responsive">
<table class="table table-bordered table-condensed" id="Exportar_a_Excel" border="1">
<thead>
<tr class="active">
<th>ITEM</th>
<th>CÓDIGO</th>
<th>DESCRIPCIÓN</th>
<th>UNIDAD</th>
<th>CANT.</th>
<th  style="text-align: center"><i class="glyphicon glyphicon-edit text-primary"></i></th>
<th  style="text-align: center"><i class="glyphicon glyphicon-trash text-danger"></i></th>
</tr>
</thead>
<?php 
$link=Conectarse();

$sql="SELECT (ROW_NUMBER() OVER(ORDER BY  ADESCRI))AS ITEM,
ACODIGO,UPPER(ADESCRI) AS ADESCRI,AUNIDAD,
(CANTPRE_REQUISD) AS CANTIDAD,USUARIO
FROM [020BDCOMUN].DBO.PRE_REQUISD AS PRD 
INNER JOIN [011BDCOMUN].DBO.MAEART AS M 
ON PRD.CODIGOPRE_REQUISD=M.ACODIGO  WHERE USUARIO='$Usuariosesion' AND
PRD.TIPOPRE_REQUISD='OT-CC'  AND M.AFSTOCK='S'
";
$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("NO TENEMOS DATOS PARA MOSTRAR");
while($row=mssql_fetch_array($result))
{
?>
<tbody>
<tr class="success">
<?php 	
$txta ='modal-containera-';
$txtxa='#modal-containera-';
$txta .=$j;
$txtxa=$txtxa.=$j;

$txt  ='modal-container-';
$txtx ='#modal-container-';
$txt  .=$i;
$txtx =$txtx.=$i;
?>
<td><?php echo $row[ITEM]; ?></td>
<td style="mso-number-format:'@'"><?php echo $row[ACODIGO]; ?></td>
<td style="mso-number-format:'@'"><?php echo utf8_encode($row[ADESCRI]); ?></td>
<td style="mso-number-format:'@'"><?php echo $row[AUNIDAD]; ?></td>
<td style="mso-number-format:'0.00'"><?php echo $row[CANTIDAD]; ?></td>
<td style="text-align: center"><a id="modal-542224" href='<?php echo $txtxa;?>' 
role="button" class="btn" data-toggle="modal">
<i class="glyphicon glyphicon-edit text-primary"></i></a></td>
<td style="text-align: center"><a id="modal-542224" href='<?php echo $txtx;?>' 
role="button" class="btn" data-toggle="modal">
<i class="glyphicon glyphicon-trash text-danger"></i></a></td>

<!-- INICIO MODAL ACTUALIZAR -->	
<div class="modal fade" id="<?php echo $txta;?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-primary text-center" id="myModalLabel">
ACTUALIZAR  CANTIDAD
</h4>
</div>
<div class="modal-body">
<div class="row clearfix">
<form action="../actualizar/editar-pre-requerimiento.php" method="POST">
<div class="col-md-12 column">
<label for="">CÓDIGO:</label>
<input type="text" name="codigo" class="form-control" readonly="" 
value="<?php echo $row[ACODIGO]; ?>">
<label for="">DESCRIPCIÓN:</label>
<input type="text" name="" class="form-control" readonly=""
value="<?php echo utf8_encode($row[ADESCRI]); ?>">
<label for="">CANTIDAD ACTUAL:</label>
<input type="text" name="" class="form-control" readonly=""
value="<?php echo $row[CANTIDAD]; ?>">
<label for="">CANTIDAD NUEVA:</label>
<input type="number" name="cantidad" min="1" 
class="form-control">
<input type="hidden" name="usuario" value="<?php echo $Usuariosesion; ?>">
</div>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Actualizar</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
</form>
</div>
</div>

</div>

</div>
<!-- FIN MODAL ACTUALIZAR  -->	





<!--INICIO MODAL ELIMINAR -->	
<div class="modal fade" id="<?php echo $txt;?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-danger text-center" id="myModalLabel">
ELIMINAR ARTICULO
</h4>
</div>
<div class="modal-body">
¿Esta seguro de eliminar el código 
<label class="text-danger"><?php echo $row[ACODIGO]; ?></label>?
<form action="../eliminar/editar-pre-requerimiento.php" method="POST">
<input type="hidden" name="codigo" value="<?php echo $row[ACODIGO];?>" >
<input type="hidden" name="usuario" value="<?php echo $Usuariosesion; ?>" >
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-danger">Eliminar</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
</form>

</div>
</div>

</div>

</div>
<!-- FIN MODAL ELIMINAR  -->	



</tr>
<?php 
$i=$i+1;
$j=$j+1; 

}?>
</tbody>


</table>


</div>
</div>
</div>
</div>



<!--INICIO MODAL LIBERAR DATOS -->
<div class="modal fade" id="modal-container-449362" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-danger text-center" id="myModalLabel">
CONFIRMAR ELIMINACIÓN
</h4>
</div>
<div class="modal-body">
¿Esta seguro de liberar la data cargada ,tenga en cuenta que los datos se eliminaran
completamente?
</div>
<div class="modal-footer">
<a href="../eliminar/liberar-pre-requerimiento.php?usuario=<?php echo $Usuariosesion; ?>" 
class="btn btn-danger">Si estoy seguro</a>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
</div>
</div>

</div>

</div>
<!-- FIN MODAL LIBERAR DATOS -->
</body>
</html>