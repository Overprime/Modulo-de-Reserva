<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<?php
//VARIABLES DE SESION 
session_start();
$IDUSUARIO=$_SESSION['id_usuario'];	
$COD_SOLICITANTE=$_SESSION['starsoft'];
?>
</head>
<body>

<div class="container">




<div class="row clearfix">

<div class="col-md-12 column">

<div class="table-responsive">


<script type="text/javascript" language="javascript" src="js/jslistadonuevo.js"></script>

<table class="table table-bordered table-condensed" id="tabla_lista_nuevo">
<thead>
<tr class="success">
<th>IT</th>
<th>NOTA  DE INGRESO</th>
<th>ORDEN DE COMPRA</th>
<th>REQUERIMIENTO</th>
<th>SOLICITANTE</th>
<th width="100">OT / CC</th>
<th style="text-align: center">FECHA DE NI</th>
<th>PROVEEDOR</th>
<th>RAZÓN SOCIAL</th>
<th><i class="glyphicon glyphicon-edit"></i> </th>





</tr>
<?php require_once('../../bd/conexion.php');
$link=  Conectarse();
$listado=  mssql_query("SELECT (ROW_NUMBER() OVER(ORDER BY MC.CANUMDOC))AS ITEM,MC.CANUMDOC AS  NI,
	OC_SOLICITA,TDESCRI,	C.OC_CNUMORD AS OC,C.OC_CNRODOCREF AS RQ,CONVERT(VARCHAR,MC.CAFECDOC,105)AS FECHA,
	OC_ORDFAB AS OT,C.OC_CRAZSOC AS NOMPROV,C.oc_ccodpro AS CODPROV
,A.CC AS CENTROCOSTO FROM  [011BDCOMUN].DBO.COMOVC AS C INNER JOIN 
[011BDCOMUN].DBO.MOVALMCAB AS MC ON C.OC_CNUMORD=MC.CANUMORD  INNER JOIN 
[020BDCOMUN].DBO.AUD_RQ AS A ON 
C.OC_CNRODOCREF=A.NROREQUI INNER JOIN 
[011BDCOMUN].DBO.TABAYU AS T ON C.OC_SOLICITA=T.TCLAVE AND TCOD='12'
WHERE C.OC_CSITORD IN ('03','04')AND C.OC_CDOCREF='RQ'
AND MC.CAALMA='01' AND MC.CATD='NI' AND CACODMOV='CL' 
AND MC.CASITGUI='V' /*AND OC_SOLICITA='138' */   AND A.ESTADO='P' 
AND MC.CAFECDOC  BETWEEN '2015-05-26' AND '2055-12-31'
  AND MC.CANUMDOC  NOT IN (SELECT NRODOCUMENTO FROM 
[020BDCOMUN].DBO.DOCUMENTO ) ORDER BY MC.CANUMDOC 
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
<td><?php echo utf8_encode($reg[NI]); ?></td>
<td><?php echo utf8_encode($reg[OC]); ?></td>
<td><?php echo utf8_encode($reg[RQ]); ?></td>
<td><?php echo $reg[TDESCRI]; ?></td>
<td><?php echo $reg[OT].$reg[CENTROCOSTO]; ?></td>
<td style="text-align: center"><?php echo utf8_encode($reg[FECHA]); ?></td>
<td><?php echo utf8_encode($reg[CODPROV]); ?></td>
<td><?php echo utf8_encode($reg[NOMPROV]); ?></td>
<td><form action="../pages/detalle-ingreso" method="POST">			
<input type="hidden" name="documento" value="<?php echo $reg[NI]; ?>">
<input type="hidden" name="ot" value="<?php echo $reg[OT]; ?>">
<input type="hidden" name="id" value="<?php echo $reg[IDAUD]; ?>">
<input type="hidden" name="cc" value="<?php echo $reg[CENTROCOSTO]; ?>">
<input type="hidden" name="os" value="<?php echo $reg[OC_SOLICITA]; ?>">
<input type="hidden" name="nomsol" value="<?php echo $reg[TDESCRI]; ?>">
<input type="hidden" name="fecha" value="<?php echo $reg[FECHA]; ?>">
<button class="btn btn-default"><i class="glyphicon glyphicon-edit text-primary"></i></button>


</form></td>

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
$sql="SELECT CTNNUMERO FROM [021BDCOMUN].DBO.NUM_DOCCOMPRAS WHERE CTNCODIGO='RV' ";
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
$Sql ="SELECT OF_COD,OF_ARTNOM,OF_ESTADO FROM [015BDCOMUN].dbo.ORD_FAB
WHERE OF_ESTADO ='ACTIVO'  AND 
OF_COD NOT IN (SELECT CODIGOOT FROM [021BDCOMUN].DBO.CENCOSOT)
ORDER BY OF_COD";

//OF_COD NOT IN (SELECT CODIGOOT FROM [021BDCOMUN].DBO.CENCOSOT) ORDER BY OF_COD
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
from [015BDCONTABILIDAD].DBO.CENTRO_COSTOS 
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