<?php 
include("../bd/conexion.php");



$Reserva=$_REQUEST['reserva'];
$Documento=$_REQUEST['documento'];
$IDAUD=$_REQUEST['idaud'];
/*Insertamos los nuevos Datos*/

$link=Conectarse();
$Sql=" INSERT INTO [020BDCOMUN].dbo.RESERVA_DET
(NRORESERVA,CODIGO,CANTIDAD,CANT_PEND,ITEM,DESCRIPCION,NUMERO_DOC,UNIDAD)
SELECT '$Reserva',M.DECODIGO,M.DECANTID,M.DECANTID,M.DEITEM,MA.ADESCRI,M.DENUMDOC,M.DEUNIDAD
FROM [011BDCOMUN].dbo.MOVALMDET as M INNER JOIN [011BDCOMUN].DBO.MAEART AS MA 
ON M.DECODIGO=MA.ACODIGO  WHERE M.DENUMDOC='$Documento' AND M.DETD='NI'
";

$Sql1="UPDATE [020BDCOMUN].DBO.AUD_RQ SET ESTADO='P',CANUMDOC='' WHERE
IDAUD_RQ='$IDAUD'";

$Sql2="INSERT INTO [020BDCOMUN].DBO.DOCUMENTO VALUES('$Documento','A')";

$Sql3="UPDATE [020BDCOMUN].DBO.AUD_DOCUMENTO SET ESTADO='A' WHERE CANUMDOC='$Documento'";
$Sql4="UPDATE [020BDCOMUN].DBO.RESERVA_DET SET 
CANT_PEND=RD.CANTIDAD-D.DECANTID
FROM [011BDCOMUN].DBO.MOVALMCAB AS C 
INNER JOIN [011BDCOMUN].DBO.MOVALMDET AS D ON
C.CANUMDOC=D.DENUMDOC AND CANUMDOC='$Documento'AND  CATD='NI' AND DETD='NI'
  INNER JOIN [020BDCOMUN].DBO.RESERVA_DET  AS RD 
ON D.DECODIGO=RD.CODIGO AND D.DENUMDOC=RD.NUMERO_DOC AND NRORESERVA=423";

$result=mssql_query($Sql);
if (!$result){echo "Error al guardar";}

else {


$result1=mssql_query($Sql1);
$result2=mssql_query($Sql2);
$result3=mssql_query($Sql3);
$result4=mssql_query($Sql4);
?>

<script>  

alert('La transferencia se realizo exitosamente');


</script>

<script>


//window.location ="/inventarios/overprime/inventarios/moduloreserva/pages/actualizar-reserva-ni?numeroreserva="+<?php echo $Reserva; ?>;

window.location ="/overprime/inventarios/moduloreserva/consulta/reservas";


</script>
<?php 

}
?>



}