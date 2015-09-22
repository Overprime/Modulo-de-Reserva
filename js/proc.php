<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Document</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>



<div class="row clearfix">

<div class="col-md-12 column">


<div class="table-responsive">


<table class="table table-bordered">
<thead>
<tr class="success">
<th width="100">NOMBRE</th>
</tr>	
</thead>
<tbody>	
<?php 
include '../bd/conexion.php';

$q=$_POST[q];
$link=Conectarse();
$sql="SELECT ACODIGO from MAEART where ACODIGO LIKE '".$q."%'";

$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("NO  HAY RESULTADOS PARA SU BÚSQUEDA");

while($row=mssql_fetch_array($result))
{
echo "<tr class='active'>


<td> $row[ACODIGO] </td>
</tr>";
}
?>

</tbody>

</table>
</div>
</div>

</div>




</body>
</html>