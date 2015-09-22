<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>ACTUALIZAR NI</title>
<link rel="shortcut icon" type="image/x-icon" href="/overprime/inventarios/moduloreserva/img/favicon.ico">
<META HTTP-EQUIV="REFRESH"
CONTENT="1;URL=http://192.168.1.27/overprime/inventarios/moduloreserva/actualizar-ni"> 
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
<h3>
<?php echo "FECHA ACTUAL:";echo $FECHA=date('Y-m-d'); ?>
</h3>
<h3>
<?php echo "HORA ACTUAL:";echo $HORA=date('H:i:s'); ?>
</h3>
<h1>
<?php  
include('bd/conexion.php');

$link=Conectarse();
$Sql="INSERT INTO [020BDCOMUN].DBO.RESERVA_DET(NRORESERVA,CODIGO,CANTIDAD,OT,ITEM,
	DESCRIPCION,NUMERO_DOC,UNIDAD,ESTADO,REQUERIMIENTO,CANT_PEND)
SELECT '423',DECODIGO,DECANTID,CAORDFAB,DEITEM,DEDESCRI,CANUMDOC,DEUNIDAD,'00','',DECANTID 
 FROM [011BDCOMUN].DBO.MOVALMCAB  AS C  INNER JOIN 
[011BDCOMUN].DBO.MOVALMDET  AS D ON C.CANUMDOC=D.DENUMDOC
 WHERE CATD='NI' AND CAALMA='01' AND  DETD='NI' AND DEALMA='01' AND 
 DECODMOV='CL' AND DEESTADO='V'  AND CACODMOV='CL' 
AND C.CAFECDOC   BETWEEN '$FECHA' AND '2050-12-31' 
AND CAORDFAB IN (SELECT  CODIGOOT FROM [020BDCOMUN].DBO.CENCOSOT )
AND DENUMDOC NOT IN (SELECT CANUMDOC FROM [020BDCOMUN].DBO.AUD_DOCUMENTO)
ORDER BY DENUMDOC,DEITEM";

 $Sql1="INSERT INTO [020BDCOMUN].DBO.AUD_DOCUMENTO(CANUMDOC)
SELECT  CANUMDOC
 FROM [011BDCOMUN].DBO.MOVALMCAB  AS C 
 WHERE CATD='NI' AND CAALMA='01' AND   CACODMOV='CL' 
AND C.CAFECDOC   BETWEEN '$FECHA' AND '2050-12-31' 
AND CAORDFAB IN (SELECT  CODIGOOT FROM [020BDCOMUN].DBO.CENCOSOT )
AND CANUMDOC NOT IN (SELECT CANUMDOC FROM [020BDCOMUN].DBO.AUD_DOCUMENTO)
GROUP BY CANUMDOC
ORDER BY CANUMDOC
  ";


$result=mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{
$result1=mssql_query($Sql1);

?>
<?php echo "ACTUALIZANDO NI,NO CERRRAR LA VENTANA." ?>

<?php

}



?>
</h1>
<h2>ÁREA DE TI</h2>
</body>
</html>