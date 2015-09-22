			<!DOCTYPE html>
			<html lang="es">
			<head>
			<?php 	include('../header.php'); 
			
			//VARIABLES:
			$NRORESERVA=$_REQUEST['reserva'];			
			?>
			
			<?php 
			
			/*Realizamos la consulta para llenar los datos
			con el id que hemos seleccionado*/
			
			$link=Conectarse();
			$sql="SELECT CRV.NRORESERVA,CRV.OT,T.TDESCRI,CRV.CENTROCOSTO,CRV.TIPO FROM [020BDCOMUN].DBO.RESERVA_CAB AS CRV
			INNER JOIN [011BDCOMUN].DBO.TABAYU AS T ON CRV.SOLICITANTE=T.TCLAVE WHERE TCOD='12' AND 
			CRV.ESTADO='00' AND CRV.NRORESERVA='$NRORESERVA'";
			$result=mssql_query($sql,$link);
			if ($row=mssql_fetch_array($result)) {
			mssql_field_seek($result,0);
			while ($field=mssql_fetch_field($result)) {
			
			}do {
			/*Almacenamos los  datos en variables*/
			
			$RESERVA=$row[0];
			$OT=$row[1];
			$SOLICITANTE=$row[2];
			$CC=$row[3];
			$TIPO=$row[4];
			} while ($row=mssql_fetch_array($result));
			
			
			}else { 
			echo "NO hay nada";
			
			} 
			
			
			?>
			</head>
			<body>
			<div class="container">
			
			<div class="row clearfix">
			<div class="col-md-3 column">
			<div class="table-responsive">	
			
			<table class="table table-bordered table-condensed">	
			
			<thead>	
			<tr class="success"><th>NRO. DE RESERVA:</th></tr>
			<tr class="active"><td><?php echo $NRORESERVA; ?></td></tr>
			<tr class="success"><th>SOLICITANTE:</th></tr>
			<tr class="active"><td><?php echo $SOLICITANTE; ?></td></tr>
			<tr class="success"><th><?php 
			if ($TIPO=='ot-cc') {
			echo "OT:";
			} 
else
	{echo "CC:";}

			?>
			</th></tr>
			<tr class="active"><td><?php echo $OT.$CC; ?></td></tr>
			
			</thead>
			</table>
			</div>	
			</div>
			
			<div class="col-md-9 column">
			<div class="table-responsive">	
			<table class="table table-bordered table-condensed">	
			
			<thead>	
			<tr class="warning">	
			<th>ITEM</th>
			<th>CÓDIGO</th>
			<th>DESCRIPCION</th>
			<th>UNIDAD</th>
			<th>CANTIDAD</th>
		
			</tr>
			</thead>
			<?php 
			$link=Conectarse();
			$sql="SELECT (ROW_NUMBER() OVER(ORDER BY CODIGO))AS ITEM,CODIGO,ADESCRI,AUNIDAD,CANTIDAD FROM [020BDCOMUN].DBO.RESERVA_DET AS D 
			INNER JOIN [011BDCOMUN].DBO.MAEART AS M ON 	D.CODIGO=M.ACODIGO
			WHERE NRORESERVA='$NRORESERVA' ";
			$result= mssql_query($sql) or die(mssql_error());
			if(mssql_num_rows($result)==0) die("NO TENEMOS DATOS PARA MOSTRAR");
			while($row=mssql_fetch_array($result))
			{
			?>
			<tbody>	
			<tr class="active">
			<td><?php echo $row[ITEM]; ?></td>
			<td><?php echo $row[CODIGO]; ?></td>
			<td><?php echo utf8_encode($row[ADESCRI]); ?></td>
			<td><?php echo $row[AUNIDAD]; ?></td>
			<td><?php echo $row[CANTIDAD]; ?></td>
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