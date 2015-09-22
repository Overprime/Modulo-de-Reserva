				<!DOCTYPE html>
				<html lang="es">
				<head>
				<meta charset="UTF-8">
				<title>TRASALADAR NI</title>
				<?php include('../bd/conexion.php'); ?>
				<?php 
				//VARIABLES:
				$RESERVA=$_REQUEST['reserva'];
				
				
				
				?>
				<link href="/overprime/inventarios/moduloreserva/css/bootstrap.min.css" rel="stylesheet">
				<link rel="shortcut icon" href="/overprime/inventarios/moduloreserva/img/favicon.ico">
				<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/jquery.min.js"></script>
				<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/bootstrap.min.js"></script>
				<script type="text/javascript" src="/overprime/inventarios/moduloreserva/js/scripts.js"></script>
				</head>
				<body>
				<div class="container">	
				<div class="row clearfix">
				<div class="col-md-12 column">
				<h3 class="text-primary text-center">FORMULARIO DE TRASLADO</h3>
				<p></p>
				<form action="../actualizar/trasladar-ni.php" method="POST">
				<label>RESERVA ACTUAL:</label>
				<input type="text" name="reservaorigen"class="form-control" value="<?php echo $RESERVA; ?>" READONLY>
				<label for="">RESERVA DE DESTINO</label>
				<select name="reservadestino" id="" class="form-control" required>
				<option value="">Seleccione la reserva...</option>
				<?php
				$link=Conectarse();
				$Sql="SELECT NRORESERVA,OT FROM [020BDCOMUN].DBO.RESERVA_CAB
				WHERE ESTADO='00' AND NRORESERVA NOT LIKE '$Reserva' AND 
				NRORESERVA NOT IN (SELECT NRORESERVA FROM [020BDCOMUN].DBO.RESERVA_DET)
				";
				$result       =mssql_query($Sql) or die(mssql_error());
				while ($row   =mssql_fetch_array($result)) {
				?>
				<option value ="<?php echo $row['NRORESERVA']?>"><?php echo $row['NRORESERVA'].'--->'.$row['OT']?></option>
				<?php }?>
				</select>
				<br>
				<button class="btn btn-block btn-primary btn-lg">TRASLADAR</button>
				
				
				</form>
				
				
				</div>
				</div>
				</div>
				</body>
				</html>