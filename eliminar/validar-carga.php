		<?php 
		
		//Iniciar Sesion
		session_start();
		
		//Validar si se esta ingresando con sesion correctamente
		if (!$_SESSION){
		echo '<script language = javascript>
		alert("usuario no autenticado")
		self.location = "/overprime/inventarios/moduloreserva/"
		</script>';
		}
		
		$id_usuario = $_SESSION['id_usuario'];
		
		
		
		
		include("../bd/conexion.php"); 
		$link=Conectarse(); 
		
		$Sql="DELETE FROM [020BDCOMUN].DBO.DATOS_RSV  WHERE  USUARIO='$id_usuario' AND TIPO='OT-CC'";
		$Sql1="DELETE FROM [020BDCOMUN].DBO.DATOS_RSV  WHERE  USUARIO='$id_usuario' AND TIPO='CC'";
		$Sql2="DELETE FROM [020BDCOMUN].DBO.PRE_REQUISD  WHERE  USUARIO='$id_usuario' AND 
		TIPOPRE_REQUISD='OT-CC'";
		$Sql3="UPDATE [020BDCOMUN].DBO.RESERVA_DET SET 
		CANT_PEND=RD.CANTIDAD-D.REQ_CANTIDAD_DESPACHADA
		FROM [011BDCOMUN].DBO.INV_REQMATERIAL_CAB AS C 
		INNER JOIN [011BDCOMUN].DBO.INV_REQMATERIAL_DET AS D ON
		C.REQ_NUMERO=D.REQ_NUMERO  INNER JOIN [020BDCOMUN].DBO.RESERVA_DET  AS RD
		ON D.ACODIGO=RD.CODIGO AND C.REQ_NUMERO=RD.REQUERIMIENTO";
		$result=mssql_query($Sql);
		
		if (!$result){echo "Error al guardar";}
		else{
		
		$result1=mssql_query($Sql1);
		$result2=mssql_query($Sql2);
		$result3=mssql_query($Sql3);
		?>
		<script>
		
		window.location = "/overprime/inventarios/moduloreserva/archivo/pages/cargar";
		</script>
		
		<?php
		
		}
		
		
		
		?>