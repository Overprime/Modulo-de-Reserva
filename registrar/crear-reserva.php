<?php 
session_start();
$IDAREA=$_SESSION['idarea'];
$AUD_JEFE=$_SESSION['aud_jefe'];
include("../bd/conexion.php"); 
$link=Conectarse(); 

$Numeroreserva=$_REQUEST['numeroreserva'];
$Solicitante=$_REQUEST['solicitante'];
$Ot=$_REQUEST['ot'];
$Estado ="00";
$Usuario =$_REQUEST['usuario'];
$Centrocosto =$_REQUEST['cencos'];
$TIPO=$_REQUEST['tipo'];
$Sql="INSERT INTO [020BDCOMUN].DBO.RESERVA_CAB(SOLICITANTE,OT,ESTADO,USUARIO,
	REQUERIMIENTO,IDAREA,AUD_JEFE,CENTROCOSTO,TIPO,FECHA) 
VALUES('$Solicitante','$Ot','$Estado','$Usuario','','$IDAREA','$AUD_JEFE',
	'$Centrocosto','$TIPO',GETDATE())";
$Sql1="UPDATE [020BDCOMUN].DBO.NUM_DOCCOMPRAS SET  CTNNUMERO='$Numeroreserva' WHERE 
 CTNCODIGO='RV'";

$result         =mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{

$result1         =mssql_query($Sql1);
?>

<script type="text/javascript">alert('RESERVA CREADA');</script>
<script>

window.location = "/overprime/inventarios/moduloreserva/consulta/reservas";
</script>

<?php

}





?> 