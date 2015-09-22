<!DOCTYPE html>
<html lang="es">
<head>
<?php include('../header.php'); ?>
<?php $Requerimiento=$_REQUEST['rq'];
$Suma=$Requerimiento;
echo "$SUMA";
function ceros($numero, $ceros=2){
return sprintf("%0".$ceros."s", $numero ); 
}
$Numero= ceros($Suma, 10);?>
</head>
<body>
<div class="container">
<div class="row clearfix">

<div class="col-md-4 column">

</div>
<div class="col-md-4 column">

<img src="../img/aprobado.png" alt="" class="img-responsive">
<h3 class="text-primary">El requerimiento 
 fue insertado exitosamente.</h3>
<a  href="../home" 
class="btn btn-lg btn-success btn-block">VOLVER AL INICIO</a>

</div>
</div>

</div>
</body>
</html>