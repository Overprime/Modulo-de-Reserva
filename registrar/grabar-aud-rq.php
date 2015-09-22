<?php 

session_start();
include('../bd/conexion.php');

$link=Conectarse();
$Requerimiento=$_REQUEST['requerimiento'];
$Solicitante=$_REQUEST['solicitante'];
$Usuario=$_SESSION['id_usuario'];
$Fecha=date('Y-m-d H:i:s');
$Ot=$_REQUEST['ot'];

$Sql="INSERT INTO [020BDCOMUN].DBO.AUD_RQ(NROREQUI,CODSOLIC,TIPOREQUI,USUARIO,FECHA,ESTADO,
CANUMDOC,OT,CC)VALUES('$Requerimiento','$Solicitante','RQ','$Usuario','$Fecha','P','','$Ot','')";


$result=mssql_query($Sql);


if (!$result) {
	
	echo"error";
}
else

{

?>
<script type='text/javascript'>
alert('REQUERIMIENTO AGREGADO CORRECTAMENTE');
</script>

<script type="text/javascript">
	window.location ="/overprime/inventarios/moduloreserva/pages/grabar-requerimiento";
</script>


<?php

}








 ?>