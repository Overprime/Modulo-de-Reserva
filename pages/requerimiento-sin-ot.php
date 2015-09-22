<!DOCTYPE html>
<html lang="es">
<head>
<?php include('../header.php');

/*DATOS SESION*/
$usuario=$_SESSION['id_usuario'];
$solicitante=$_SESSION['starsoft'];

/*VARIABLES*/
$Reserva=$_REQUEST['reserva'];
$CC=$_REQUEST['cc'];
?>
<?php 

/*Realizamos la consulta para llenar los datos
con el id que hemos seleccionado*/

$link=Conectarse();
$sql="SELECT CTNCODIGO,CTNNUMERO AS REQ FROM [011BDCOMUN].dbo.NUM_DOCCOMPRAS
Where ctncodigo = 'RM' ;";
$result=mssql_query($sql,$link);
if ($row=mssql_fetch_array($result)) {
mssql_field_seek($result,0);
while ($field=mssql_fetch_field($result)) {

}do {
/*Almacenamos los  datos en variables*/

$Codigo=$row[0];
$Requerimiento=$row[1];
} while ($row=mssql_fetch_array($result));


}else { 
echo "NO hay nada";

} 

$Req=$Requerimiento+1;

function ceros($numero, $ceros=2){
return sprintf("%0".$ceros."s", $numero ); 
}
$Numero= ceros($Req, 10);

?>
</head>
<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-4 column">
<form action="../registrar/requerimiento-materiales.php" method="POST"
autocomplete='Off'>
<!-- Inicio Datos Ocultos -->
<input type="hidden" value="<?php echo date("Y-m-d");?>"  name="fechaemision">
<input type="hidden" value="<?php echo $solicitante; ?>" name="solicitante">
<input type="hidden"  name="estado" value="00">
<input type="hidden"  name="usuario" value="userweb">
<input type="hidden" name="despacho" value="0">
<input type="hidden" name="autorizada" value="0">
<input type="hidden" name="sumadoc" value="1">
<input type="hidden" name="usuariosesion" value="<?php 	echo $usuario; ?>">
<!-- Fin Datos Ocultos -->

<label for="">NRO. DE RESERVA:</label>
<input type="text" class="form-control" name="nroreserva" value="<?php echo $Reserva; ?>" readonly>
</div>
<div class="col-md-4 column">
<label for="">NRO. REQ. DE MATERIALES::</label>
<input type="text" class="form-control"name="nrorequerimiento" value="<?php echo $Numero; ?>" readonly>
</div>
<div class="col-md-4 column">
<label for="">CENTRO DE COSTOS:</label>
<input type="text" class="form-control"name="cc" value="<?php echo $CC;?>" readonly>
</div>
</div>
<div class="row clearfix">
<div class="col-md-4 column">
<label for="">FECHA DE EMISION:</label>
<input type="text" class="form-control"name="" id=""
value="<?php echo date("d-m-Y");?>"  readonly>
</div>
<div class="col-md-4 column">
<label for="">FECHA DE ENTREGA:</label>
<input type="date" class="form-control"name="fechaentrega" id="" required
min='<?php echo date("Y-m-d");?>'>
</div>
<div class="col-md-4 column">
<label for="">DESCRICPIÓN CENTRO DE COSTO:</label>
<select name="cencos" class="form-control" required>
<?php
$link=Conectarse();
$Sql ="SELECT  CENCOST_CODIGO,CENCOST_DESCRIPCION,
(CENCOST_DESCRIPCION+' - '+CENCOST_CODIGO)as fullname
from [015BDCONTABILIDAD].DBO.CENTRO_COSTOS WHERE CENCOST_CODIGO='$CC'
";
$result    =mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option value              ="<?php echo $row['CENCOST_CODIGO']?>">
<?php echo utf8_encode($row['fullname']);?></option>
<?php }?>
</select>
</div>
</div>
<div class="row clearfix">
<div class="col-md-8 column">
<label for="">COMENTARIO:</label>
<input name="comentario" type="text"  class="form-control"
placeholder="Ingresar Comentario" onchange="conMayusculas(this);">
</div>
<div class="col-md-4 column">
<br>		
<a id="modal-96205" href="#modal-container-96205" role="button"
class="btn btn-lg btn-success btn-block"  data-toggle="modal">GRABAR RQ. DE MATERIALES</a>
<div class="modal fade" id="modal-container-96205" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-primary text-center" id="myModalLabel">
CONFIRMACÍON
</h4>
</div>
<div class="modal-body">
¿Esta seguro de Grabar el Requerimiento de Materiales N° <b><?php echo $Numero; ?></b>,con los 
datos ingresados previamente?
</div>
<div class="modal-footer">
 <button type="submit" class="btn btn-primary">Si estoy seguro</button>
 <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>

 </form>
</div>
</div>

</div>

</div>

</div>
</div>
<div class="row clearfix">
<div class="col-md-12 column">
<p></p>
<div class="table-responsive">

<table class="table table-bordered table-condensed">		
<thead>	
<tr class="active">	
<th>ITEM</th>
<th>CODIGO</th>
<th>DESCRICPION</th>
<th>CANTIDAD</th>
<th>UNIDAD</th>
</tr>
</thead>

<?php 

$link=Conectarse();
$sql="SELECT  (ROW_NUMBER()  OVER(ORDER BY D.CODIGO))AS ITEM, D.CODIGO,M.ADESCRI,D.CANTIDAD,M.AUNIDAD
FROM [020BDCOMUN].DBO.RESERVA_DET AS D INNER JOIN [020BDCOMUN].dbo.RESERVA_CAB  AS C ON 
D.NRORESERVA=C.NRORESERVA  INNER JOIN [011BDCOMUN].DBO.MAEART AS M ON 
D.CODIGO=M.ACODIGO WHERE C.USUARIO='$usuario' AND C.NRORESERVA='$Reserva'

";
$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("NO TENEMOS DATOS PARA MOSTRAR");
while($row=mssql_fetch_array($result))
{
?>
<tbody>	
<tr class="success">			
<td><?php echo $row[ITEM]; ?></td>
<td><?php echo utf8_encode($row[CODIGO]); ?></td>
<td><?php echo utf8_encode($row[ADESCRI]); ?></td>
<td><?php echo $row[CANTIDAD]; ?></td>
<td><?php echo $row[AUNIDAD]; ?></td>
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