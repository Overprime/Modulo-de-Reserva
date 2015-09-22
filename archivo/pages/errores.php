<!DOCTYPE html>
<html lang="es">
<head>
<?php include('../../header.php');?>

</head>
<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-3 column">
<br>	

<a href="consulta" class="btn btn-lg btn-warning btn-block" >Regresar</a>
</div>

</div>
<div class="row clearfix">
<div class="col-md-6 column">
<p>	</p>		
<div class="table-responsive">
<table class="table table-bordered table-condensed">

<thead>
<tr class="danger">
<th>ITEM</th>
<th>CODIGO</th>
<th>CANTIDAD</th>
</tr>
</thead>
<?php 	
//VARIABLE DE SESION:
$usuario=$_SESSION['id_usuario'];

$link=Conectarse();
$sql="SELECT (ROW_NUMBER() OVER(ORDER BY D.CODIGO DESC))AS ITEM,D.CODIGO,D.CANTIDAD
FROM [020BDCOMUN].DBO.DATOS_RSV  AS D  LEFT  JOIN [011BDCOMUN].DBO.MAEART AS M 
ON D.CODIGO=M.ACODIGO 
WHERE D.CODIGO NOT IN (SELECT ACODIGO FROM [011BDCOMUN].DBO.MAEART)
AND D.USUARIO='$usuario'

";
$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("NO TENEMOS DATOS PARA MOSTRAR");
while($row=mssql_fetch_array($result))
{

?>
<tbody>
<tr class="active">			
<td><?php echo $row[ITEM]; ?></td>
<td><?php echo $row[CODIGO]; ?></td>
<td><?php echo $row[CANTIDAD]; ?></td>

</tr>
<?php 
}?>
</tr>
</tbody>
</table>

</div>

</div>
</div>
</div>
</body>
</html>