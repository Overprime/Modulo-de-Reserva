
<?php 
//Iniciar Sesion
session_start();
$IDUSUARIO = $_SESSION['id_usuario'];
include("../bd/conexion.php"); 
$link=Conectarse(); 

$Sql="DELETE FROM [020BDCOMUN].DBO.DATOS_RSV WHERE USUARIO='$IDUSUARIO'
AND TIPO='OT-CC'";
$result=mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{

?>

<script>alert('DATA LIBERADA CORRECTAMENTE');</script>
<script>

window.location = "/overprime/inventarios/moduloreserva/home";
</script>

<?php

}





?> 