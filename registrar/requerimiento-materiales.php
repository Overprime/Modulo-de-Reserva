<?php 

/*Inicio de variables recibidad por POST*/
$Numeroreserva=$_REQUEST['nroreserva'];
$Numerorequerimiento=$_REQUEST['nrorequerimiento'];
$Ot=$_REQUEST['ot'];
$Fechaemision=$_REQUEST['fechaemision'];
$Fechaentrega=$_REQUEST['fechaentrega'];
$Estado=$_REQUEST['estado'];
$Usuario=$_REQUEST['usuario'];
$Despacho=$_REQUEST['despacho'];
$Autorizada=$_REQUEST['autorizada'];
$Glosa=$_REQUEST['comentario'];
$Solicitante=$_REQUEST['solicitante'];
$Cencos=$_REQUEST['cencos'];
$Sumadoc=$_REQUEST['sumadoc'];
$Usuariosesion=$_REQUEST['usuariosesion'];
/*Fin de variables recibidad por POST*/

/*Insertamos los nuevos Datos */  

include('../bd/conexion.php');
$link=Conectarse();

$Sql ="INSERT INTO [011BDCOMUN].DBO.INV_REQMATERIAL_CAB
(REQ_NUMERO,REQ_FECHA_EMISION,REQ_FECHA_ENTREGA,REQ_ESTADO,REQ_PERSONAL_SOLIC,REQ_GLOSA,REQ_USUARIO
,REQ_FECHA_CREACION,CENCOST_CODIGO)
VALUES('$Numerorequerimiento','$Fechaemision','$Fechaentrega','$Estado','$Solicitante','$Glosa',
	'$Usuario','$Fechaemision','$Cencos')" ;

$Sql1="INSERT INTO [011BDCOMUN].dbo.INV_REQMATERIAL_DET
(REQ_NUMERO,REQ_ITEM,ACODIGO,REQ_CANTIDAD_REQUERIDA,REQ_CANTIDAD_AUTORIZADA,REQ_CANTIDAD_DESPACHADA,
CENCOST_CODIGO,REQ_COMENTARIO1,REQ_COMENTARIO2,REQ_CUENTA )
SELECT '$Numerorequerimiento',ROW_NUMBER() OVER (ORDER BY NRORESERVA ),CODIGO,CANTIDAD,'$Despacho',
'$Autorizada','$Cencos','$Ot','',''FROM [020BDCOMUN].DBO.RESERVA_DET WHERE NRORESERVA='$Numeroreserva'";

$Sql2="UPDATE [011BDCOMUN].dbo.NUM_DOCCOMPRAS SET CTNNUMERO=CTNNUMERO+$Sumadoc WHERE CTNCODIGO='RM' ";

$Sql3="UPDATE [020BDCOMUN].DBO.RESERVA_CAB SET ESTADO='01',
REQUERIMIENTO='$Numerorequerimiento' WHERE NRORESERVA='$Numeroreserva' ";

$Sql4="UPDATE [020BDCOMUN].DBO.RESERVA_DET SET 
REQUERIMIENTO='$Numerorequerimiento' WHERE NRORESERVA='$Numeroreserva' ";

$result=mssql_query($Sql);

if (!$result){echo "Error al guardar";}

else {

$result1=mssql_query($Sql1);
$result2=mssql_query($Sql2);
$result3=mssql_query($Sql3);
$result4=mssql_query($Sql4);

echo"<script>  

alert('El Requerimiento $Requerimiento  se grabo satisfactoriamente');


</script>";

echo "<script>


window.location ='/overprime/inventarios/moduloreserva/consulta/rq-materiales';

</script>";
}


?>
