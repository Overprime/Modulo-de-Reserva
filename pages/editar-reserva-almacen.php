			<!DOCTYPE html>
			<html lang="es">
			<head>
			<meta charset="UTF-8">
			<title>EDITAR RESERVA</title>
			<?php include('../header.php'); ?>
			<?php 
			session_start();
			
			$IDUSUARIO = $_SESSION['id_usuario'];
			$Reserva=$_REQUEST['reserva'];
			//$Codigo=$_REQUEST['codigo'];
			//$OT=$_REQUEST['ot']; ?>
			</head>
			<body>
			
			<div class="container">
			<div class="row clearfix">
			<div class="col-md-12 column">
			<div class="table-responsive">
			
			<table class="table table-condensed table-bordered">
			<thead>
			<tr class="success">
			<th>NRO. RESERVA</th>
			<th>SOLICITANTE</th>
			<th>OT / CC</th>
			</tr>
			</thead>
			<?php
			$link=  Conectarse();
			$listado=  mssql_query("SELECT CRV.NRORESERVA,CRV.OT,CRV.CENTROCOSTO,
			T.TDESCRI,CRV.USUARIO,T.TCLAVE,CRV.IDAREA FROM
			[020BDCOMUN].DBO.RESERVA_CAB AS CRV
			INNER JOIN [011BDCOMUN].DBO.TABAYU AS T ON CRV.SOLICITANTE=T.TCLAVE WHERE TCOD='12' AND 
			CRV.ESTADO='00' AND NRORESERVA='$Reserva' AND AUD_ALM='$IDUSUARIO'
			ORDER BY CRV.NRORESERVA DESC ",$link);
			?>
			<tbody>
			<?php
			while($reg=  mssql_fetch_array($listado)) 
			{
			?>
			<tr >
			<td><?php echo $reg[NRORESERVA]; ?></td>
			<td><?php echo $reg[TDESCRI]; ?></td>
			<td><?php echo $reg[OT].$reg[CENTROCOSTO]; ?></td>
			
			<?php $IDAREA=$reg[IDAREA]; ?>
			</tr>
			<?php
			}
			?>
			</tbody>
			</table>
			</div>
			</div>
			</div>
			
			<div class="row clearfix">
			<div class="col-md-12 column">
			<div class="table-responsive">
			<table class="table table-bordered table-condensed">
			<thead>
			<tr class="danger">
			<th>IT</th>
			<th>CODIGO</th>
			<th>DESCRIPCION</th>
			<th>UND</th>
			<th>CANT.</th>
			<th>OT / CC</th>
			<?php
			
			if ($IDAREA==2) {
			echo "<th style='text-align: center'>
			<i class='glyphicon glyphicon-shopping-cart text-primary'></i></th>";
			}else
			{echo "";}
			
			?>
			<td style="text-align: center"><i class="glyphicon glyphicon-edit text-primary"></i></td>
			<td style="text-align: center"><i class="glyphicon glyphicon-trash text-danger"></i></td>
			
			
			</tr>
			
			</thead>
			
			<?php 
			$link=  Conectarse();
			$listado=  mssql_query("SELECT (ROW_NUMBER() OVER(ORDER BY DRV.NRORESERVA))AS ITEM,CRV.NRORESERVA,
			DRV.CODIGO,M.ADESCRI,DRV.CANTIDAD,CRV.IDAREA,
			M.AUNIDAD,CRV.OT,CRV.CENTROCOSTO
			FROM [020BDCOMUN].DBO.RESERVA_DET AS DRV  INNER JOIN 
			[020BDCOMUN].DBO.RESERVA_CAB AS CRV ON DRV.NRORESERVA=CRV.NRORESERVA 
			AND CRV.AUD_ALM='$IDUSUARIO' INNER JOIN 
			[011BDCOMUN].DBO.MAEART AS M ON DRV.CODIGO=M.ACODIGO  
			WHERE DRV.NRORESERVA='$Reserva' /*AND DRV.CANTIDAD >=1*/",$link);
			?>
			
			<tbody>
			<?php
			while($reg=  mssql_fetch_array($listado)) 
			{
			?>
			<tr>
			<?php 
			$txta                      ='modal-containera-';
			$txtxa                     ='#modal-containera-';
			$txta                      .=$j;
			$txtxa                     =$txtxa.=$j;
			
			$txt                       ='modal-container-';
			$txtx                      ='#modal-container-';
			$txt                       .=$i;
			$txtx                      =$txtx.=$i;
			
			
			$txtb                       ='modal-containerb-';
			$txtxb                     ='#modal-containerb-';
			$txtb                      .=$k;
			$txtxb                      =$txtxb.=$k;
			
			?>
			
			<td><?php echo $reg[ITEM]; ?></td>
			<td><?php echo $reg[CODIGO]; ?></td>
			<td><?php echo utf8_encode($reg[ADESCRI]); ?></td>
			<td><?php echo $reg[AUNIDAD]; ?></td>
			<td><?php echo $reg[CANTIDAD]; ?></td>
			<td><?php echo $reg[OT].$reg[CENTROCOSTO]; ?></td>
			<?php 
			if ($IDAREA==2) {
			?>
			<td style="text-align: center"class="text-primary">
			<a id="modal-899574" href='<?php echo $txtxa;?>'
			role="button" class="btn" data-toggle="modal">
			<i class="glyphicon glyphicon-shopping-cart text-primary">	</i></a>
			</td>
			
			<?php
			}
			else{echo "";}
			
			?>
			<td style="text-align: center"class="text-primary">
			<a id="modal-899574" href='<?php echo $txtxb;?>'
			role="button" class="btn" data-toggle="modal">
			<i class="glyphicon glyphicon-edit text-primary">	</i></a>
			</td>
			<td style="text-align: center"class="text-primary">
			<a id="modal-899574" href='<?php echo $txtx;?>'
			role="button" class="btn" data-toggle="modal">
			<i class="glyphicon glyphicon-trash text-danger">	</i></a>
			</td>
			
			
			
			
			
			
			
			<!-- INICIO MODAL TRASLADAR -->
			<div class="modal fade" id="<?php echo $txta;?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title text-primary" id="myModalLabel">
			TRASALADAR ARTICULOS
			</h4>
			</div>
			<div class="modal-body">
			<form action="../actualizar/trasladar.php" method="POST">
			<label for="">RESERVA:</label>
			<input type="text" name="reservaorigen" id=""  class="form-control" value="<?php echo $reg[NRORESERVA]; ?>"  readonly>
			<label for="">CODIGO:</label>
			<input type="text" name="codigo" id=""  class="form-control" value="<?php echo $reg[CODIGO]; ?>"  readonly>
			<label for="">DESCRIPCION:</label>
			<textarea name="" id="" cols="30" rows="3"  class="form-control" readonly>
			<?php echo utf8_encode($reg[ADESCRI]); ?>
			</textarea>
			<label for="">CANTIDAD ACTUAL:</label>
			<input type="text" name="" id=""  class="form-control" value="<?php echo $reg[CANTIDAD]; ?>"  readonly>
			<label for="">CANTIDAD A TRASLADAR:</label>
			<input type="number" name="cantidad" id=""  class="form-control" min="1" max="<?php echo $reg[CANTIDAD]; ?>" required>
			
			<label for="">Reserva de Destino</label>
			<select name="reservadestino" id="" class="form-control" required>
			<option value="">Seleccione la reserva...</option>
			<?php
			$Sql="SELECT NRORESERVA,OT,TDESCRI,CENTROCOSTO FROM [020BDCOMUN].DBO.RESERVA_CAB AS C 
			INNER JOIN [011BDCOMUN].DBO.TABAYU AS T ON C.SOLICITANTE=T.TCLAVE AND TCOD='12'
			WHERE ESTADO='00' AND NRORESERVA NOT LIKE '$Reserva' ORDER BY NRORESERVA";
			$result       =mssql_query($Sql) or die(mssql_error());
			while ($row   =mssql_fetch_array($result)) {
			?>
			<option value ="<?php echo $row['NRORESERVA']?>"><?php echo $row['NRORESERVA'].' ----> '.$row['OT'].$row[CENTROCOSTO].' ----> '.$row['TDESCRI']?></option>
			<?php }?>
			</select>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Trasladar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
			
			</form>
			</div>
			</div>
			
			</div>
			
			</div>
			<!-- FIN MODAL TRASLADAR -->
			
			
			<!-- INICIO MODAL ACTUALIZAR -->
			<div class="modal fade" id="<?php echo $txtb;?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title text-primary" id="myModalLabel">
			ACTUALIZAR ARTICULO
			</h4>
			</div>
			<div class="modal-body">
			<form action="../actualizar/detalle-reserva.php" method="POST">
			<label for="">RESERVA:</label>
			<input type="text" name="reserva" id=""  class="form-control" value="<?php echo $reg[NRORESERVA]; ?>"  readonly>
			<label for="">CODIGO:</label>
			<input type="text" name="codigo" id=""  class="form-control" value="<?php echo $reg[CODIGO]; ?>"  readonly>
			<label for="">DESCRIPCION:</label>
			<textarea name="" id="" cols="30" rows="3"  class="form-control" readonly>
			<?php echo utf8_encode($reg[ADESCRI]); ?>
			</textarea>
			<label for="">CANTIDAD ACTUAL:</label>
			<input type="text" name="" id=""  class="form-control" value="<?php echo $reg[CANTIDAD]; ?>"  readonly>
			<label for="">CANTIDAD NUEVA:</label>
			<input type="number" name="cantidad" id=""  class="form-control" min="1" max="<?php echo $reg[CANTIDAD]; ?>" required>
			
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Actualizar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
			
			</form>
			</div>
			</div>
			
			</div>
			
			</div>
			<!-- FIN MODAL ACTUALIZAR -->
			
			
			
			<!-- INICIO MODAL ELIMINAR -->
			<div class="modal fade" id="<?php echo $txt;?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title text-danger" id="myModalLabel">
			ELIMINAR ARTICULO
			</h4>
			</div>
			<div class="modal-body">
			<form action="../eliminar/detalle-reserva.php" method="POST">
			¿Se procedera a elimar el codigo <label class="text-danger">
			<?php echo $reg[CODIGO]; ?>	</label><label class="text-success">-
			<?php echo $reg[ADESCRI]; ?>	</label>?
			<input type="hidden" name="reserva"    value="<?php echo $reg[NRORESERVA]; ?>" >
			<input type="hidden"  name="codigo" value="<?php echo $reg[CODIGO]; ?>" >
			
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-danger">Eliminar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
			
			</form>
			</div>
			</div>
			
			</div>
			
			</div>
			<!-- FIN MODAL ELIMINAR -->
			
			
			</tr>
			<?php
			$i=$i+1;
			$j=$j+1;
			$k=$k+1; 
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