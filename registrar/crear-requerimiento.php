			
			<?php 
			include("../bd/conexion.php");
			$Requerimiento=$_REQUEST['requerimiento'];
			$Mensaje=$Requerimiento;
			//$Centro=$_REQUEST['centro'];
			$Orden=$_REQUEST['orden'];
			$Maquina=$_REQUEST['maquina'];
			$Usuario=$_REQUEST['usuario'];
			$Solicitante=$_REQUEST['solicitante'];
			$Fecha=date('Y-m-d');
			$link=Conectarse();
			$sql="SELECT  CODIGOCENTROCOSTO FROM [020BDCOMUN].DBO.CENCOSOT	WHERE CODIGOOT='$Orden'";
			$result       =mssql_query($sql,$link);
			if ($row      =mssql_fetch_array($result)) {
			mssql_field_seek($result,0);
			while ($field =mssql_fetch_field($result)) {
			
			}do {
			/*Almacenamos los  datos en variables*/
			
			$Centro         =$row['CODIGOCENTROCOSTO'];
			
			} while ($row =mssql_fetch_array($result));
			
			}else { 
			?>
			
			<?php 
			} 
			
			
			$Sql="INSERT INTO [011BDCOMUN].DBO.REQUISD(NROREQUI,codpro,DESCPRO,UNIPRO,CANTID,
			ESTREQUI,FECREQUE,REQITEM,SALDO,
			CENCOST,GLOSA,REMAQ,TIPOREQUI,ORDFAB_REQUI)
			SELECT '$Requerimiento',ACODIGO,ADESCRI,AUNIDAD,CANTPRE_REQUISD,'P','$Fecha',
			(ROW_NUMBER() OVER(ORDER BY  D.CODIGOPRE_REQUISD))AS ITEM,
			CANTPRE_REQUISD,'$Centro','','$Maquina','RQ','$Orden'
			FROM PRE_REQUISD AS D INNER JOIN [011BDCOMUN].DBO.MAEART AS M  ON
			D.CODIGOPRE_REQUISD=M.ACODIGO WHERE D.USUARIO='$Usuario' AND M.AFSTOCK='S'
			ORDER BY (ROW_NUMBER() OVER(ORDER BY  D.CODIGOPRE_REQUISD))";
			
			$Sql1="DELETE FROM [011BDCOMUN].DBO.REQUISD
			WHERE NROREQUI='$Requerimiento' AND codpro='TEXTO' AND DESCPRO='RESERVA'";
			
			
			$Sql2="DELETE FROM [020BDCOMUN].DBO.PRE_REQUISD WHERE USUARIO='$Usuario'";
			
			$Sql3="INSERT INTO [020BDCOMUN].DBO.AUD_RQ(NROREQUI,CODSOLIC,TIPOREQUI,USUARIO,FECHA,ESTADO,OT)
			VALUES('$Requerimiento','$Solicitante','RQ','$Usuario','$Fecha','P','$Orden')";
			
			$result=mssql_query($Sql);
			if (!$result){echo "Error al guardar";}
			
			else {
			
			$result1=mssql_query($Sql1);
			$result2=mssql_query($Sql2);
			$result3=mssql_query($Sql3);
			?>
			
			<script type="text/javascript">
			
			alert('REQUERIMIENTO GENERADO EXITOSAMENTE');
			</script>
			<script>
			
			window.location = "/overprime/inventarios/moduloreserva/mensaje/requerimiento?rq="+<?php echo $Requerimiento; ?>;
			</script>
			
			<?php
			
			}
			
			
			?>