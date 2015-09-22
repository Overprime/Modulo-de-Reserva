					<!DOCTYPE html>
					<html lang="es">
					<head>
					<meta charset="UTF-8">
					<title>ACTUALIZAR STOCK</title>
					<link rel="shortcut icon" type="image/x-icon" href="/overprime/inventarios/moduloreserva/img/favicon.ico">
					<META HTTP-EQUIV="REFRESH"
					CONTENT="1;URL=http://192.168.1.27/overprime/inventarios/moduloreserva/actualizar-correlativo"> 
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
					
					/*VALIDAMOS EL STOCK DEL ARTICULO*/
					include('bd/conexion.php');
					$link=Conectarse();
					$sql="SELECT TOP 1 NRORESERVA FROM RESERVA_CAB   order by NRORESERVA  desc	";
					$result       =mssql_query($sql,$link);
					if ($row      =mssql_fetch_array($result)) {
					mssql_field_seek($result,0);
					while ($field =mssql_fetch_field($result)) {
					
					}do {
					/*Almacenamos los  datos en variables*/
					echo "ÚLTIMO REGISTRO:";
					echo "</br>";
					echo $Correlativo        =$row[0];
					
					} while ($row =mssql_fetch_array($result));
					
					}else { 
					?>
					
					<?php 
					} 
					
					?>
					
					
					
					
					<?php  
					
					
					$link=Conectarse();
					$Sql="UPDATE  NUM_DOCCOMPRAS SET CTNNUMERO='$Correlativo'  WHERE CTNCODIGO='RV'	";
					
					
					$result         =mssql_query($Sql);
					
					if (!$result){echo "Error al guardar";}
					else{
					
					?>
					<?php $Numero= $Correlativo+1;
					echo "</br>";
					echo "PROXIMO REGISTRO:";
					echo "</br>";
					echo $Numero;
					
					?>
					
					<?php
					
					}
					
					
					
					?>
					</h1>
					<h2>ÁREA DE TI</h2>
					</body>
					</html>