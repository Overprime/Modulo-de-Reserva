							<!DOCTYPE html>
							<html lang="en">
							<head>
							<meta charset="UTF-8">
							<title>	</title>
							<?php 	include('header.php'); ?>
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
							<table class="table table-condensed table-bordered">
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
							</thead>
							<?php 
							
							$link=Conectarse();
							$sql=" SELECT (ROW_NUMBER() OVER(ORDER BY MC.CANUMDOC))AS ITEM,MC.CANUMDOC AS  NI,
							OC_SOLICITA,TDESCRI,
							C.OC_CNUMORD AS OC,C.OC_CNRODOCREF AS RQ,CONVERT(VARCHAR,MC.CAFECDOC,105)AS FECHA,
							OC_ORDFAB AS OT,C.OC_CRAZSOC AS NOMPROV,C.oc_ccodpro AS CODPROV
							,A.CC AS CENTROCOSTO FROM  [011BDCOMUN].DBO.COMOVC AS C INNER JOIN 
							[011BDCOMUN].DBO.MOVALMCAB AS MC ON C.OC_CNUMORD=MC.CANUMORD  INNER JOIN 
							[020BDCOMUN].DBO.AUD_RQ AS A ON 
							C.OC_CNRODOCREF=A.NROREQUI INNER JOIN 
							[011BDCOMUN].DBO.TABAYU AS T ON C.OC_SOLICITA=T.TCLAVE AND TCOD='12'
							WHERE C.OC_CSITORD IN ('03','04')AND C.OC_CDOCREF='RQ'
							AND MC.CAALMA='01' AND MC.CATD='NI' AND CACODMOV='CL' 
							AND MC.CASITGUI='V' /*AND OC_SOLICITA='138' */   AND A.ESTADO='P'  and 
							MC.CAFECDOC  BETWEEN '2015-05-26' AND '2055-12-31' and 
							MC.CANUMDOC  NOT IN (SELECT NRODOCUMENTO FROM 
							[020BDCOMUN].DBO.DOCUMENTO ) ORDER BY MC.CANUMDOC ";  
							$result= mssql_query($sql) or die(mssql_error());
							if(mssql_num_rows($result)==0) die("No hay registros para mostrar");
							
							while($row=mssql_fetch_array($result))
							{?>
							<tbody>
							<tr>
							<td><?php echo utf8_encode($row[ITEM]); ?></td>
							<td><?php echo utf8_encode($row[NI]); ?></td>
							<td><?php echo utf8_encode($row[OC]); ?></td>
							<td><?php echo utf8_encode($row[RQ]); ?></td>
							<td><?php echo $row[TDESCRI]; ?></td>
							<td><?php echo $row[OT].$row[CENTROCOSTO]; ?></td>
							<td style="text-align: center"><?php echo utf8_encode($row[FECHA]); ?></td>
							<td><?php echo utf8_encode($row[CODPROV]); ?></td>
							<td><?php echo utf8_encode($row[NOMPROV]); ?></td>
							<td><form action="pages/detalle-ingreso-new" method="POST">			
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