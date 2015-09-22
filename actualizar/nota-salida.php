<?php 


include("../bd/conexion.php");

/*Almacenamos en variables los datos de formulario
notemos que se estan enviando en metodo POST*/


$DOCUMENTO =$_REQUEST['documento'];
$OF        =$_REQUEST['of'];
/*Insertamos los nuevos Datos*/

$link=Conectarse();

$Sql ="UPDATE  [011BDCOMUN].DBO.MOVALMDET SET DEORDFAB='$OF'
WHERE DENUMDOC='$DOCUMENTO' AND DETD='NS'  AND DEALMA='01' AND DEALMA='01' " ;

$Sql1="UPDATE [011BDCOMUN].DBO.MOVALMCAB SET CAORDFAB='$OF' 
WHERE CANUMDOC='$DOCUMENTO' AND CATD='NS' AND CATIPMOV='S' AND CAALMA='01'";

$result=mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{

$result=mssql_query($Sql1);
?>
<script>  

alert('El documento <?php echo $DOCUMENTO; ?> fue actualizado');</script>

</script>

<script>

window.location = "/overprime/inventarios/moduloreserva/consulta/nota-salida";
</script>

<?php

}



?>


