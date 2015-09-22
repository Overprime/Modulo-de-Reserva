<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>LISTA DE VERIFICACIÓN</title>
<?php include('../header.php'); ?>
<?php 
//ATRIBUTOS DE SESION
$Starsoft=$_SESSION['starsoft'];
$Usuariosesion=$_SESSION['id_usuario'];?>
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
<div class="col-md-9 column">
<h3 class="text-center text-success">LISTA DE VERIFICACIÓN</h3>
</div>
<div class="col-md-3 column">

<form action="reporte-excel.php" method="post" target="_blank" id="FormularioExportacion">
<p> <i class="fa fa-file-excel-o fa-5x botonExcel tamano text-success" title="DESCARGAR" id="#excel" ></i>

</p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>


</div>		
</div>
<div class="row clearfix">
<div class="col-md-12 column">
<div class="table-responsive">
<table class="table table-bordered table-condensed" id="Exportar_a_Excel" border="1">
<thead>
<tr class="success">
<th>ITEM</th>
<th>CÓDIGO</th>
<th>DESCRIPCIÓN</th>
<th>CANTIDAD</th>
<th>UNIDAD</th>

</tr>
</thead>
<?php 
$link=  Conectarse();
$listado=  mssql_query("SELECT (ROW_NUMBER() OVER(ORDER BY  ADESCRI))AS ITEM,
ACODIGO,UPPER(ADESCRI) AS ADESCRI,AUNIDAD,
(CANTPRE_REQUISD) AS CANTIDAD,USUARIO
FROM [020BDCOMUN].DBO.PRE_REQUISD AS 
PRD INNER JOIN [011BDCOMUN].DBO.MAEART AS M 
ON PRD.CODIGOPRE_REQUISD=M.ACODIGO  WHERE USUARIO='$Usuariosesion'
AND AESTADO='V' AND
PRD.TIPOPRE_REQUISD='CC'   AND M.AFSTOCK='S'",$link);
?>
<tbody>
<?php
while($reg=  mssql_fetch_array($listado)) 
{
?>
<tr>
<td><?php echo $reg[ITEM]; ?></td>
<td style="mso-number-format:'@'"><?php echo utf8_encode($reg[ACODIGO]); ?></td>
<td><?php echo utf8_encode($reg[ADESCRI]); ?></td>
<td style="mso-number-format:'0.00'"><?php echo $reg[CANTIDAD]; ?></td>
<td><?php echo $reg[AUNIDAD]; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</body>
</html>