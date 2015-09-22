<!DOCTYPE html>
<html lang="es">
<head>
<meta content="text/html; charset=iso-8859-1" http-equiv=Content-Type>
<meta charset  ="utf-8">
<title>REPORTE</title>

<link href="../css/bootstrap.min.css" rel="stylesheet">

<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/style-reporte.css" rel="stylesheet">
<link rel      ="shortcut icon" href="../img/favicon.ico">
<?php  include('../bd/conexion.php'); ?>
<?php $Numerorequerimiento=$_REQUEST['id'];   ?>

<?php ?>
<?php ?>
</head>

</head>
<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-12 column">
<nav class="navbar navbar-default" role="navigation">


<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

<form class="navbar-form navbar-left" role="search">
<div class="form-group">
</div> <button type="button" onclick="window.print();"
class="btn btn-default text-success" >
<span  class="glyphicon glyphicon-print text-primary" title="IMPRIMIR" ></span></button>
</form>

<form class="navbar-form navbar-left" role="search">
<div class="form-group">
</div> <button type="button" onclick="window.close();"
class="btn btn-default text-success" >
<span  class="glyphicon glyphicon-remove text-danger" title="CERRAR" ></span></button>
</form>
</div>

</nav>
</div>
</div> 
<div class="row clearfix">
<div class="col-md-12 column">
<center><img width="300" height="40" src="../img/logoreporte.png" />	</center>
</div>
</div>
<div class="row clearfix">
<div class="col-md-12 column">

<h5 class="text-center text-success">REQUERIMIENTO DE MATERIALES Nro. <?php 
echo "$Numerorequerimiento"; ?></h5>

<!-- Carga de datos cabecera-->

<?php 

/*Realizamos la consulta para llenar los datos
con el id que hemos seleccionado*/

$link=Conectarse();
$sql="SELECT (T.TDESCRI) AS DESCRI,INVC.REQ_GLOSA,
(CONVERT(VARCHAR(10),INVC.REQ_FECHA_EMISION , 105))AS FECHA,
INVD.REQ_COMENTARIO1,(INVC.CENCOST_CODIGO) AS CENCOS
FROM [011BDCOMUN].DBO.INV_REQMATERIAL_CAB  AS INVC 
INNER JOIN [011BDCOMUN].DBO.INV_REQMATERIAL_DET  AS INVD 
ON INVC.REQ_NUMERO=INVD.REQ_NUMERO INNER JOIN [011BDCOMUN].DBO.MAEART AS M ON INVD.ACODIGO=M.ACODIGO INNER JOIN [011BDCOMUN].DBO.TABAYU AS T ON
INVC.REQ_PERSONAL_SOLIC=T.TCLAVE WHERE   T.TCOD=12  AND INVC.REQ_NUMERO=$Numerorequerimiento;";
$result=mssql_query($sql,$link);
if ($row=mssql_fetch_array($result)) {
mssql_field_seek($result,0);
while ($field=mssql_fetch_field($result)) {

}do {
/*Almacenamos los  datos en variables*/

$Nombre=$row[0];
$Glosa=$row[1];
$Fecha=$row[2];
$Ot=$row[3];
$Centrocosto=$row[4];
} while ($row=mssql_fetch_array($result));


}else { 
echo "NO hay nada";

} 

?>
<!--  Carga de datos cabecera-->



<table  id="tabla-cabecera" class="table table-bordered table-condensed">
<thead>
<tr>
<th  width="40" height="40">FECHA DE EMISION:</th>
<td  width="160"><?php echo $Fecha;?></td>
<th  width="80">SOLICITANTE:</th>
<th id="cabeceralistados"width="200"><?php echo $Nombre;?> </th>

</tr>
<tr>
<th width="40" height="40">COMENTARIO:</th>
<td width="160" ><?php echo $Glosa;?></td>
<th  width="">JEFE DE AREA SOLICITANTE:</th>
<td  width=""> </td>

</tr>

<tr>

<th width="40" height="40">NOTA DE SALIDA:</th>
<td width="160"></td>
<th>ENCARGADO DE ALMACEN:</th>
<td> </td>


</tr>

</tbody>
</table>
<table id="tabla-comentario" class="table table-bordered table-condensed">
<thead>

<tr>
<th>PRIORIDAD:
<input type="checkbox">URGENTE
<input type="checkbox">NORMAL

</th>
</tr>
<tr>	
<th>OBSERVACION:</th>

</tr>



</thead>


</table>

</div>
</div>
<div class="row clearfix">
<div class="col-md-12 column">
<table class="table table-bordered table-condensed" id="tabla-detalle" >
<thead>
<tr class="success">
<th>IT</th>
<th>CODIGO</th>
<th>DESCRIPCION</th>
<th>CANT. SOLIC.</th>
<th>SALDO</th>
<th>TOTAL DESPACHADO </th>
<th>CANT. ENTREGADA</th>
<th>UND</th>
<th>C. COSTOS</th>
<th>O/T</th>
<th>UBICACION</th>
</tr>
</thead>
<?php 
$link=Conectarse();

$sql="SELECT INVD.REQ_ITEM,INVD.ACODIGO,M.ADESCRI,M.AUNIDAD,
INVD.REQ_CANTIDAD_REQUERIDA AS CANT,
(INVD.REQ_CANTIDAD_REQUERIDA-INVD.REQ_CANTIDAD_DESPACHADA) as SALDO ,
TC.TCASILLERO,
(INVD.REQ_CANTIDAD_REQUERIDA-(INVD.REQ_CANTIDAD_REQUERIDA-INVD.REQ_CANTIDAD_DESPACHADA) )AS DESPACHO,
INVD.CENCOST_CODIGO,INVD.REQ_COMENTARIO1
FROM [011BDCOMUN].DBO.INV_REQMATERIAL_CAB  AS INVC 
INNER JOIN [011BDCOMUN].DBO.INV_REQMATERIAL_DET  AS INVD 
ON INVC.REQ_NUMERO=INVD.REQ_NUMERO 
INNER JOIN [011BDCOMUN].DBO.MAEART AS M ON INVD.ACODIGO=M.ACODIGO  
LEFT JOIN [011BDCOMUN].DBO.TABCASILLERO AS TC ON 
M.ACODIGO=TC.TCODART  AND TCODALM='01'
INNER JOIN [011BDCOMUN].DBO.TABAYU AS T ON
INVC.REQ_PERSONAL_SOLIC=T.TCLAVE   WHERE 
  T.TCOD=12   AND INVC.REQ_NUMERO='$Numerorequerimiento'
  ORDER BY TCASILLERO";
$result                                                      = mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)                                   ==0) die("NO TENEMOS DATOS PARA MOSTRAR");

while($row                                                   =mssql_fetch_array($result))
{

?>
<tbody>
<tr >
<?php 
echo "
<td width='10'> $row[REQ_ITEM] </td>
<td width='150'> $row[ACODIGO] </td>
<td width='450'> $row[ADESCRI] </td>
<td> $row[CANT]</td>
<td>$row[SALDO]</td>
<td>$row[DESPACHO]</td>
<td></td>
<td> $row[AUNIDAD]  </td>
<td width='90'> $row[CENCOST_CODIGO]</td>
<td width='90'> $row[REQ_COMENTARIO1]  </td>
<td width='90'> $row[TCASILLERO]  </td>


</tr>";
}?>

</tbody>
</table>
</div>
</div>
</div>
</body>
</html>