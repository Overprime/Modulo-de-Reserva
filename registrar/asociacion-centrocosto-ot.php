<?php 


include("../bd/conexion.php");
$ip="$_SERVER[REMOTE_ADDR]";
/*Almacenamos en variables los datos de formulario
notemos que se estan enviando en metodo POST*/
$Centrodecosto  = $_REQUEST['centrodecosto'];
$Ot  =  $_REQUEST['ot'];
//$Nombrepc=$_POST['nombrepc'];

/*Insertamos los nuevos Datos*/

$link=Conectarse();
//Iniciar Sesion
session_start();

//Validar si se estÃ¡ ingresando con sesion correctamente
if (!$_SESSION){
echo '<script language = javascript>
alert("usuario no autenticado")
self.location = "/overprime/inventarios/moduloreserva/acceso"
</script>';
}

$id_usuario = $_SESSION['id_usuario'];
$Sql ="INSERT INTO [020BDCOMUN].DBO.CENCOSOT
(CODIGOCENTROCOSTO,CODIGOOT,FECHA,HORA,USUARIO,NOMBRE_PC)
VALUES('$Centrodecosto','$Ot',GETDATE(),
	Convert(varchar(8),GetDate(), 108),'$id_usuario','$ip')";

$result=mssql_query($Sql);

if (!$result){echo "Error al guardar";}

else{

echo "<script>


window.location ='/overprime/inventarios/moduloreserva/consulta/cencos-ot';

</script>";
}


?>