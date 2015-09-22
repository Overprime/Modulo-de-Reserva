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

<style type="text/css">
	th,td
	{
     font-size: 13px;
	}

	.centrar{
		text-align: center;
	}
</style>
</head>
<body>

<div class="container">




<div class="row clearfix">

<div class="col-md-12 column">

<div class="table-responsive">


<script type="text/javascript" language="javascript" src="js/jslistadoni-new.js"></script>

<table class="table table-bordered table-condensed" id="tabla_lista_ni-new">
<thead>
<tr class="success">
<th width="5">IT</th>
<th width="100" class="centrar">NI</th>
<th width="100" class="centrar">OC</th>
<th width="100" class="centrar">RQ</th>
<th width="200">SOLICITANTE</th>
<th width="100" class="centrar">OT</th>
<th width="100" class="centrar">FECHA</th>
<th width="100">RUC</th>
<th width="400">RAZÓN SOCIAL</th>
<th width="10" style="text-align: center"><i class="glyphicon glyphicon-edit"></i> </th>





</tr>
<?php require_once('../../bd/conexion.php');
$link=  Conectarse();
$listado=  mssql_query("SELECT (ROW_NUMBER() OVER(ORDER BY MC.CANUMDOC))AS ITEM,MC.CANUMDOC AS  NI,
	OC_SOLICITA,TDESCRI,
	C.OC_CNUMORD AS OC,C.OC_CNRODOCREF AS RQ,CONVERT(VARCHAR,MC.CAFECDOC,103)AS FECHA,
	OC_ORDFAB AS OT,C.OC_CRAZSOC AS NOMPROV,C.oc_ccodpro AS CODPROV
,A.CC AS CENTROCOSTO FROM  [011BDCOMUN].DBO.COMOVC AS C INNER JOIN 
[011BDCOMUN].DBO.MOVALMCAB AS MC ON C.OC_CNUMORD=MC.CANUMORD  INNER JOIN 
[020BDCOMUN].DBO.AUD_RQ AS A ON 
C.OC_CNRODOCREF=A.NROREQUI INNER JOIN 
[011BDCOMUN].DBO.TABAYU AS T ON C.OC_SOLICITA=T.TCLAVE AND TCOD='12'
INNER JOIN [020BDCOMUN].DBO.CENCOSOT  AS O ON 
OC_ORDFAB=O.CODIGOOT
WHERE C.OC_CSITORD IN ('03','04')AND C.OC_CDOCREF='RQ'
AND MC.CAALMA='01' AND MC.CATD='NI' AND CACODMOV='CL' 
AND MC.CASITGUI='V' /*AND OC_SOLICITA='138' */   AND A.ESTADO='P'  and 
MC.CAFECDOC  BETWEEN '2015-05-26' AND '2055-12-31' and 
MC.CANUMDOC  NOT IN (SELECT NRODOCUMENTO FROM 
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
<td class="centrar"><?php echo $reg[OT]; ?></td>
<td class="centrar"><?php echo utf8_encode($reg[FECHA]); ?></td>
<td><?php echo utf8_encode($reg[CODPROV]); ?></td>
<td><?php echo utf8_encode($reg[NOMPROV]); ?></td>
<td><form action="../pages/detalle-ingreso-new" method="POST">			
<input type="hidden" name="documento" value="<?php echo $reg[NI]; ?>">
<input type="hidden" name="ot" value="<?php echo $reg[OT]; ?>">
<input type="hidden" name="id" value="<?php echo $reg[IDAUD]; ?>">
<input type="hidden" name="cc" value="<?php echo $reg[CENTROCOSTO]; ?>">
<input type="hidden" name="os" value="<?php echo $reg[OC_SOLICITA]; ?>">
<input type="hidden" name="nomsol" value="<?php echo $reg[TDESCRI]; ?>">
<input type="hidden" name="fecha" value="<?php echo $reg[FECHA]; ?>">
<button class="btn btn-default"><i class="glyphicon glyphicon-edit text-primary"></i></button>


</form></td>




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

</html>