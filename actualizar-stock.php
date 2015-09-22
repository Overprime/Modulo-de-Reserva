			<!DOCTYPE html>
			<html lang="es">
			<head>
			<meta charset="UTF-8">
			<title>ACTUALIZAR STOCK</title>
			<link rel="shortcut icon" type="image/x-icon" href="/overprime/inventarios/moduloreserva/img/favicon.ico">
			<META HTTP-EQUIV="REFRESH"
			CONTENT="1;URL=http://192.168.1.27/overprime/inventarios/moduloreserva/actualizar-stock"> 
			</head>
			
			<style type="text/css">
			
			body{
			
			background-color:#b8e59e;
			
			}
			
			h1{
			margin-top: 3em;
			font-family: sans-serif;
			font-size: 60px;
			text-align: center;
			color: #ab82ff;
			
			}
			h2{
			text-align: center;
			font-family: monospace;
			color: #008fc5;
			
			
			}
			</style>
			<body>
			
			<h1>
			<?php  
			include('bd/conexion.php');
			
			$link=Conectarse();
			$Sql="UPDATE [020BDCOMUN].DBO.RESERVA_DET SET 
			CANT_PEND=RD.CANTIDAD-D.REQ_CANTIDAD_DESPACHADA
			FROM [011BDCOMUN].DBO.INV_REQMATERIAL_CAB AS C 
			INNER JOIN [011BDCOMUN].DBO.INV_REQMATERIAL_DET AS D ON
			C.REQ_NUMERO=D.REQ_NUMERO AND C.REQ_ESTADO NOT LIKE '06'  INNER JOIN [020BDCOMUN].DBO.RESERVA_DET  AS RD
			ON D.ACODIGO=RD.CODIGO AND C.REQ_NUMERO=RD.REQUERIMIENTO
			
			";
			
			
			$result         =mssql_query($Sql);
			
			if (!$result){echo "Error al guardar";}
			else{
			
			?>
			<?php echo "VENTANA EN PROCESO DE ACTUALIZACIÓN NO CERRAR." ?>
			
			<?php
			
			}
			
			
			
			?>
			</h1>
			<h2>ÁREA DE TI</h2>
			</body>
			</html>