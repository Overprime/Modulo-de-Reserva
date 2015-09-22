
<?php 
include("../bd/conexion.php");

$link=Conectarse();
//Iniciar Sesion
session_start();
$SOLICITANTE=$_SESSION['starsoft'];
$USUARIO=$_SESSION['id_usuario'];

$Requerimiento=$_REQUEST['requerimiento'];
$Mensaje=$Requerimiento;
$Centro=$_REQUEST['centro'];
//$Orden=$_REQUEST['orden'];
//$Maquina=$_REQUEST['maquina'];
//$Usuario=$_REQUEST['usuario'];
//$Solicitante=$_REQUEST['solicitante'];
$Fecha=date('Y-m-d');


/*Insertamos los nuevos Datos*/


$Sql="INSERT INTO [011BDCOMUN].DBO.REQUISD(NROREQUI,codpro,DESCPRO,UNIPRO,CANTID,
ESTREQUI,FECREQUE,REQITEM,SALDO,
CENCOST,GLOSA,REMAQ,TIPOREQUI,ORDFAB_REQUI)
SELECT '$Requerimiento',ACODIGO,ADESCRI,AUNIDAD,CANTPRE_REQUISD,'P','$Fecha',
(ROW_NUMBER() OVER(ORDER BY  D.CODIGOPRE_REQUISD))AS ITEM,
CANTPRE_REQUISD,'$Centro','','$Maquina','RQ','$Orden'
FROM PRE_REQUISD AS D INNER JOIN [011BDCOMUN].DBO.MAEART AS M  ON
D.CODIGOPRE_REQUISD=M.ACODIGO WHERE D.USUARIO='$Usuario'
ORDER BY (ROW_NUMBER() OVER(ORDER BY  D.CODIGOPRE_REQUISD))";

$Sql1="DELETE FROM [011BDCOMUN].DBO.REQUISD
WHERE NROREQUI='$Requerimiento' AND codpro='TEXTO' AND DESCPRO='RESERVA'";


$Sql2="DELETE FROM [020BDCOMUN].DBO.PRE_REQUISD WHERE USUARIO='$Usuario'";

$Sql3="INSERT INTO [020BDCOMUN].DBO.AUD_RQ(NROREQUI,CODSOLIC,TIPOREQUI,USUARIO,FECHA,ESTADO)
VALUES('$Requerimiento','$Solicitante','RQ','$Usuario','$Fecha','P')";

$result=mssql_query($Sql);
if (!$result){echo "Error al guardar";}

else {

$result1=mssql_query($Sql1);
$result2=mssql_query($Sql2);
$result3=mssql_query($Sql3);
?>
<script>

window.location = "/overprime/inventarios/moduloreserva/mensaje/requerimiento-so?rq="+<?php echo $Requerimiento; ?>;
</script>

<?php

}

?>