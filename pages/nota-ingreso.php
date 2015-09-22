<!DOCTYPE html>
<html lang="es">
<head>
<title>NOTA DE INGRESO</title>
<?php include('../header.php');?>
<?php 
/*Tomamos la variables  enviadas por post*/

$Ot=$_REQUEST['ot'];
$Num=$_REQUEST['Orden'];
$Ni=$_REQUEST['ni'];
$I=$_REQUEST['i'];


?>

</head>
<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-2 column">
<form role="form" method="GET" action="nota-ingreso.php">
<input type ="hidden" name='Orden' value="ORDEN NÚMERO:">
<input type="hidden" name="ni" value="NI"><input type="hidden" name="i" value="I">
<label>SELECCIONE LA  O/T:</label>
<select name="ot" class="form-control" onchange="this.form.submit()" required>
<option value="">Seleccione la Ot...</option>
<?php
$link=Conectarse();
$Sql ="SELECT OF_COD from [011BDCOMUN].DBO.ORD_FAB  AS O INNER JOIN 
[011BDCOMUN].DBO.MOVALMCAB AS MC ON 
O.OF_COD=MC.CAORDFAB AND CAORDFAB IS NOT NULL AND RTRIM(CAORDFAB)<>' ' WHERE UPPER(OF_ESTADO)=UPPER('ACTIVO') 
GROUP BY OF_COD";
$result=mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option    value="<?php echo $row['OF_COD']?>"><?php echo $row['OF_COD']?></option>
<?php }?>
</select>
<!-- 
<button type="submit" class="btn btn-lg btn-primary btn-block">Consultar</button> -->
</form>
</div>
<div class="col-md-10 column">
<div class="table-responsive">
<table class="table table-bordered table-hover table-condensed">
<label class="text-info"><?php echo "$Num";echo " "; echo "$Ot";?></label>
<thead>
<tr class="success">
<TH>NUM. DOC</TH>
<TH>PROVEEDOR</TH>
<TH>O/F</TH>
<TH>O/C</TH>
<TH>FECHA</TH>
<th><span class='glyphicon glyphicon-tags' title='DETALLE'> </span></th>
</tr>
</thead>

<?php 

$link=Conectarse();

$sql="SELECT  CANUMDOC, CONVERT(VARCHAR,CAFECDOC,105 )AS FECHA,PRO.PRVCNOMBRE,CANUMORD,CAORDFAB
FROM  [011BDCOMUN].dbo.MOVALMCAB C  INNER JOIN [011BDCOMUN].DBO.MAEPROV PRO  ON
C.CACODPRO=PRO.PRVCCODIGO  LEFT  JOIN [020BDCOMUN].DBO.DOCUMENTO AS D  ON
C.CANUMDOC=D.NRODOCUMENTO
WHERE CAORDFAB='$Ot' AND CATD ='$Ni' AND CATIPMOV='$I'
 AND  C.CANUMDOC NOT IN
(SELECT  NRODOCUMENTO FROM [020BDCOMUN].DBO.DOCUMENTO );";  
$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("NO HAY INFORMACION ASOCIADO A LA O/T SELECCIONADA");

while($row=mssql_fetch_array($result))
{

?>
<tbody>
<tr class="active">
<?php 
?>
<td> <?php 	echo  $row[CANUMDOC];?> </td>
<td> <?php 	echo  $row[PRVCNOMBRE];?> </td>
<td> <?php 	echo  $row[CAORDFAB];?> </td>
<td> <?php 	echo  $row[CANUMORD];?> </td>
<td> <?php 	echo  $row[FECHA];?> </td>
<td><a href="detalle-ingreso?documento=<?php echo $row[CANUMDOC];?> &
ot=<?php echo $row[CAORDFAB];?> 
">
<i class="glyphicon glyphicon-tags text-primary"></i></a></td>          


</tr>
<?php
}?>
</tbody>
</table>
</div>
</div>

</div>
</div>
</body>
</html>