<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>GRABAR REQUERIMIENTO</title>


<?php include('../header.php'); ?>
<?php 

//variables de sesion 
$Solicitante=$_SESSION['starsoft'];
$fecha=date('Y-m-d');
?>
</head>
<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-3 column">
</div>
<div class="col-md-5 column">
<div class="jumbotron">

<form action="../registrar/grabar-aud-rq.php" method="POST">
<div class="form-group">
<label class="text-primary">REQUERIMIENTOS PENDIENTES</label>
<select name="requerimiento" class="form-control"required>
<option value="">[SELECCIONAR]</option>
<?php
$link=Conectarse();
$Sql="SELECT  NROREQUI FROM [011BDCOMUN].DBO.REQUISC AS C WHERE   
TIPOREQUI='RQ'  AND ESTREQUI='P'
AND C.CODSOLIC='$Solicitante'  AND  
 C.NROREQUI NOT IN (SELECT A.NROREQUI  FROM [020BDCOMUN].DBO. AUD_RQ AS A)
AND C.FECREQUI    BETWEEN '2015-08-17' AND '2034-12-31'
";
$result=mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option value ="<?php echo $row['NROREQUI']?>"><?php echo $row['NROREQUI']?></option>
<?php }?>
</select>
</div>
<div class="form-group">
<label class="text-primary">ORDEN DE TRABAJO</label>
<select name="ot" class="form-control"required>
<option value="">[SELECCIONAR]</option>
<?php
$link=Conectarse();
$Sql="SELECT CODIGOOT FROM [020BDCOMUN].DBO.CENCOSOT AS CC
WHERE  CODIGOOT IN (SELECT OF_COD FROM [011BDCOMUN].dbo.ORD_FAB
WHERE OF_ESTADO ='ACTIVO')  ORDER BY CODIGOOT";
$result=mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option value ="<?php echo $row['CODIGOOT']?>"><?php echo $row['CODIGOOT']?></option>
<?php }?>
</select>
</div>
<div class="form-group">

<button  
id="modal-49441" href="#modal-container-49441" 
role="button" class="btn btn-lg btn-primary btn-block" data-toggle="modal">GRABAR REQUERIMIENTO</button>



<div class="modal fade" id="modal-container-49441" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h2 class="modal-title text-primary text-center" id="myModalLabel">
Confirmación
</h2>
</div>
<div class="modal-body">
¿Esta seguro de registrar el requerimiento seleccionado?
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Si estoy seguro</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
</div>
</div>

</div>

</div>





</div>
</form>

</div>
</div>
</div>
</div>
</body>
</html>