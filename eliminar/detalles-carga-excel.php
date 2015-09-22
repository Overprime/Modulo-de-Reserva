<?php 
include("../bd/conexion.php"); 
$link=Conectarse(); 
  $CODIGO=$_REQUEST['codigo']; 
  $USUARIO=$_REQUEST['usuario'];
  $TIPO=$_REQUEST['tipo']; 

$Sql="DELETE FROM [020BDCOMUN].DBO.DATOS_RSV WHERE CODIGO='$CODIGO' AND USUARIO='$USUARIO'
AND TIPO='$TIPO'";

$result=mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{
?>
<meta charset="UTF-8">

<script type="text/javascript">alert('CÓDIGO  <?php echo $CODIGO;?>    ELIMINADO');</script>

<?php 
if ($TIPO=="OT-CC") {
?>
<script>
window.location = "/overprime/inventarios/moduloreserva/archivo/pages/consulta";
</script>

<?php
}
else if($TIPO=="CC") {
?>
<script>
window.location = "/overprime/inventarios/moduloreserva/archivo/pages/consulta-sin-ot";
</script>
<?php
}
else {echo "error";}

 ?>



<?php

}



?> 