<?php 
//Proceso de conexiÃ³n con la base de datos
include('bd/conexion.php');
$link=Conectarse();
//Inicio de variables de sesiÃ³n
if (!isset($_SESSION)) {
session_start();
}

//Recibir los datos ingresados en el formulari	o
$usuario= $_POST['usuario'];
$contrasena= $_POST['contrasena'];

//Consultar si los datos son estÃ¡n guardados en la base de datos
$consulta= "SELECT * FROM [020BDCOMUN].DBO.USUARIOS
WHERE usuario='".$usuario."' AND contrasena='".$contrasena."'"; 
$resultado= mssql_query($consulta,$link) or die (mssql_error());
$fila=mssql_fetch_array($resultado);

$Sql="UPDATE [020BDCOMUN].DBO.RESERVA_DET SET 
CANT_PEND=RD.CANTIDAD-D.REQ_CANTIDAD_DESPACHADA
FROM [011BDCOMUN].DBO.INV_REQMATERIAL_CAB AS C 
INNER JOIN [011BDCOMUN].DBO.INV_REQMATERIAL_DET AS D ON
C.REQ_NUMERO=D.REQ_NUMERO  INNER JOIN [020BDCOMUN].DBO.RESERVA_DET  AS RD
ON D.ACODIGO=RD.CODIGO AND C.REQ_NUMERO=RD.REQUERIMIENTO

";


if (!$fila[0]) //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
{
echo '<script language = javascript>
alert("Usuario o Password errados, por favor verifique.")
self.location = "/overprime/inventarios/moduloreserva/"
</script>';
}
else //opcion2: Usuario logueado correctamente
{
//Definimos las variables de sesiÃ³n y redirigimos a la pÃ¡gina de usuario
$result=mssql_query($Sql);
$_SESSION['id_usuario'] = $fila['id_usuario'];
$_SESSION['nombres'] = $fila['nombres'];
$_SESSION['apellidos'] = $fila['apellidos'];
$_SESSION['starsoft'] = $fila['starsoft'];
$_SESSION['idempresa'] = $fila['idempresa'];
$_SESSION['idarea'] = $fila['idarea'];
$_SESSION['aud_jefe'] = $fila['aud_jefe'];


header("Location: /overprime/inventarios/moduloreserva/home");
}
?>