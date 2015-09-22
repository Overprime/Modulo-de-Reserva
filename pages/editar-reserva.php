<!DOCTYPE html>
<html lang="es">
<head>
<?php 
session_start();

$IDUSUARIO = $_SESSION['id_usuario'];


$Reserva=$_REQUEST['reserva'];
$Codigo=$_REQUEST['codigo'];
$OT=$_REQUEST['otcc'];
$CC=$_REQUEST['cc'];
$TIPO=$_REQUEST['tipo'];

include('../header.php');?>
<script language="Javascript">
function popupdatosextra(datos) {
window.open(datos,'','width=600,height=500,left=300,menubar=NO,titlebar=NO');
}
</script>
</head>


<?php 

/*VALIDAMOS EL STOCK DEL ARTICULO*/

$link=Conectarse();
$sql="SELECT ACODIGO,ADESCRI,
(ISNULL(STSKDIS,0)-SUM(ISNULL(CANT_PEND,0)))AS STOCK
FROM [011BDCOMUN].DBO.MAEART AS M LEFT JOIN [011BDCOMUN].DBO.STKART AS S ON
M.ACODIGO=S.STCODIGO AND STALMA='01' LEFT JOIN [020BDCOMUN].DBO.RESERVA_DET AS D ON
S.STCODIGO=D.CODIGO 

WHERE  AESTADO='V' AND AFSTOCK='S'  AND  ACODIGO='$Codigo'

GROUP BY ACODIGO,ADESCRI,STSKDIS
";
$result       =mssql_query($sql,$link);
if ($row      =mssql_fetch_array($result)) {
mssql_field_seek($result,0);
while ($field =mssql_fetch_field($result)) {

}do {
/*Almacenamos los  datos en variables*/

$Cod          =$row[0];
$Descripcion  =utf8_encode($row[1]);
$Stock        =$row[2];
} while ($row =mssql_fetch_array($result));

}else { 
?>

<?php 
} 

?>

<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-1 column">
<label for="">RESERVA:</label>
<input type="text" class="form-control" 
value="<?php echo $Reserva; ?>" readonly>
</div>	
<div class="col-md-4 column">
<form action="editar-reserva" method="POST" autocomplete="Off">
<input type="hidden" name="reserva" value="<?php echo $Reserva; ?>">
<input type="hidden" name="ot" value="<?php echo $OT; ?>">
<label for="">CÓDIGO:</label>
<input type="text" name="codigo" class="form-control"
value="<?php echo $Codigo; ?>" maxlength="25" 
placeholder='INGRESE EL CODIGO Y PRESIONE ENTER....'autofocus onchange="conMayusculas(this);">
</form>
</div>	
<div class="col-md-6 column">
<label for="">DESCRIPCIÓN:</label>
<input type="text" value="
<?php 
if (!$Descripcion) {
echo"NO HA INGRESADO UN CÓDIGO VALIDO  O NO LO HA INGRESADO";
}
else 
{
echo "$Descripcion";
}
?>"
class="form-control" readonly="">
</div>	
</div>
<div class="row clearfix">
<div class="col-md-1 column">
</div>
<div class="col-md-4 column">
<label for="">STOCK:</label>
<input type="text" value="<?php echo "$Stock"; ?>"
class="form-control" readonly="">

</div>
<div class="col-md-3 column">
<form action="../actualizar/editar-reserva.php" method="POST" autocomplete="off">
<label for="">CANTIDAD:</label>
<input type="hidden" name="codigo" value="<?php echo $Codigo?>" required>
<input type="hidden" name="numeroreserva" value="<?php echo $Reserva?>">
<input type="number" name="cantidad" class="form-control"   min='0.00000001'  step="any" 
max="<?php 
if (!$Stock) {
echo "0";
}
else
{
echo "$Stock";

}?>" required>
</div>
<div class="col-md-3 column">
<br>
<button type="submit" class="btn btn-lg btn-success btn-block" >AGREGAR</button>
</form>
</div>
</div>
<div class="row clearfix">
<div class="col-md-12 column">
<p>	</p>
<div class="table-responsive">

<table class="table table-bordered table-condensed">		
<thead>	
<tr class="active">	
<th>IT</th>
<th>CODIGO</th>
<th>DESCRIPCION</th>
<th>UND</th>
<th>CANT.</th>
<th><?php 
if ($TIPO=='ot-cc') {
echo"OT";
}else{echo "CC";}


?></th>
</tr>
</thead>

<?php 


$link=Conectarse();
$sql="SELECT (ROW_NUMBER() OVER(ORDER BY DRV.NRORESERVA))AS ITEM,CRV.NRORESERVA,
DRV.CODIGO,M.ADESCRI,DRV.CANTIDAD,
M.AUNIDAD,CRV.OT,CRV.CENTROCOSTO
FROM [020BDCOMUN].DBO.RESERVA_DET AS DRV  INNER JOIN 
[020BDCOMUN].DBO.RESERVA_CAB AS CRV ON DRV.NRORESERVA=CRV.NRORESERVA INNER JOIN 
[011BDCOMUN].DBO.MAEART AS M ON DRV.CODIGO=M.ACODIGO  
WHERE DRV.NRORESERVA='$Reserva' AND DRV.CANTIDAD <>0";
$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("NO TENEMOS DATOS PARA MOSTRAR");
while($row=mssql_fetch_array($result))
{
?>
<tbody>	
<tr class="success">	
<?php 
$txta                      ='modal-containera-';
$txtxa                     ='#modal-containera-';
$txta                      .=$j;
$txtxa                     =$txtxa.=$j;

$txt                       ='modal-container-';
$txtx                      ='#modal-container-';
$txt                       .=$i;
$txtx                      =$txtx.=$i;


?>


<td><?php echo $row[ITEM]; ?></td>
<td><?php echo $row[CODIGO]; ?></td>
<td><?php echo utf8_encode($row[ADESCRI]); ?></td>
<td><?php echo $row[AUNIDAD]; ?></td>
<td><?php echo $row[CANTIDAD]; ?></td>
<td><?php echo $row[OT].$row[CENTROCOSTO]; ?></td>
<!-- INICIO MODAL ACTUALIZAR -->
<div class="modal fade" id="<?php echo $txt;?>"  role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title" id="myModalLabel">
<label class="text-primary">Confirmación!!!</label>
</h4>
</div>
<div class="modal-body">
<div class="container">
<div class="row clearfix">
<div class="col-md-5 column">
<form action="../actualizar/detalle-reserva.php" method="POST">
<input type="hidden" name="reserva" value="<?php echo $Reserva; ?>">
<label for="">Código</label>
<input type="text" name="codigo" id="" class="form-control" value="<?php echo $row[CODIGO]; ?>"
readonly>
<label for="">Descripción</label>
<textarea name="" class="form-control" cols="30"  readonly rows="2">
<?php echo utf8_encode($row[ADESCRI]); ?></textarea>
<label for="">Cantidad Actual</label>
<input type="text" name="" id="" class="form-control"  readonly value="<?php echo $row[CANTIDAD]; ?>">
<label for="">Cantidad Nueva</label>
<input type="number" name="cantidad" id="" class="form-control" min="0.00000001" max="<?php echo $row[CANTIDAD]; ?>">
</div>
</div>

</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">SI</button>
<button type="button" class="btn btn-default" data-dismiss="modal">NO</button> 
</form>
</div>
</div>

</div>

</div>

<!-- fin modal Actualizar -->


<!-- inicio modal eliminar -->
<div class="modal fade" id="<?php echo $txta;?>"  role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title" id="myModalLabel">
<label class="text-danger">Confirmación!!!</label>
</h4>
</div>
<div class="modal-body">
<div class="container">
<div class="row clearfix">
<div class="col-md-5 column">
<form action="../eliminar/detalle-reserva.php" method="POST">
<input type="hidden" name="reserva" value="<?php echo $Reserva; ?>">
<input type="hidden" name="codigo" value="<?php 	echo $row[CODIGO]; ?>">
¿Esta seguro de eliminar el código  <label class="text-success"><?php echo $row[CODIGO];?></label>?
</div>

</div>

</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">SI</button>
<button type="button" class="btn btn-default" data-dismiss="modal">NO</button> 
</form>
</div>
</div>

</div>

</div>


</tr>

</tr>
<?php 
$i=$i+1;
$j=$j+1; 
}?>
</tbody>
</table>
</div>
</div>
</div>
</div>

</body>
</html>